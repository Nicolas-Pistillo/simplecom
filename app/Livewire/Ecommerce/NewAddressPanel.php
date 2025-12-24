<?php

namespace App\Livewire\Ecommerce;

use App\Livewire\Forms\UserAddressForm;
use App\Models\Locality;
use App\Models\Province;
use App\Models\UserAddress;
use App\Services\GoogleMaps;
use App\Traits\Livewire\WithNotifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class NewAddressPanel extends Component
{
    use WithNotifications;

    public UserAddressForm $form;

    public function updatedFormProvinceId()
    {
        $this->form->reset('locality_id');
    }

    /* public function mount(UserAddress|null $address = null)
    {
        $this->form->autocomplete($address);
    } */

    public function initialize($params)
    {
        if (is_array($params))
        {
            $params = null;
        }

        if (is_int($params))
        {
            $params = UserAddress::find($params);
        }

        $this->form->autocomplete($params);
    }

    public function continueEditing()
    {
        $this->form->reset('gmap_data', 'show_map_confirm');
    }

    public function evaluateSave()
    {
        $this->form->validate();

        $province = Province::find($this->form->province_id);
        $locality = Locality::find($this->form->locality_id);

        $parsedAddress = "{$this->form->street} {$this->form->number},{$locality->name},{$province->name},{$this->form->zipcode},Argentina";

        $geocodeResult = GoogleMaps::geocode($parsedAddress);

        if (!empty($geocodeResult) && !empty($geocodeResult['results']) 
        && count($geocodeResult['results']) === 1 
        && $geocodeResult['results'][0]['types'][0] === 'street_address')
        {
            $this->form->gmap_data = $geocodeResult['results'][0];
            $this->form->show_map_confirm = true;
            return;
        }

        return $this->save();
    }

    public function receiveDeleteAddress(UserAddress $address)
    {
        $this->form->target_delete_address = $address;
    }

    public function deleteAddress()
    {
        if (Auth::guest())
        {
            $sessionAddresses = session()->get('guest_customer.addresses');

            if (!empty($sessionAddresses))
            {
                foreach($sessionAddresses as $key => $address)
                {
                    if ($address->id === $this->form->target_delete_address->id)
                    {
                        session()->forget("guest_customer.addresses.$key");
                        break;
                    }
                }
            }
        }

        $this->form->target_delete_address->delete();

        $this->form->reset('target_delete_address');

        return redirect(request()->header('Referer'));
    }

    public function save()
    {
        try 
        {
            if ($this->form->address_id)
            {
                $address = UserAddress::find($this->form->address_id);
                
                $address->update([
                    'province_id'     => $this->form->province_id,
                    'locality_id'     => $this->form->locality_id,
                    'tag'             => $this->form->tag,
                    'zipcode'         => $this->form->zipcode,
                    'street'          => $this->form->street,
                    'number'          => $this->form->number,
                    'floor'           => $this->form->floor,
                    'apartment'       => $this->form->apartment,
                    'office'          => $this->form->office,
                    'details'         => $this->form->details,
                    'lat'             => data_get($this->form->gmap_data, 'geometry.location.lat'),
                    'lng'             => data_get($this->form->gmap_data, 'geometry.location.lng'),
                    'google_place_id' => data_get($this->form->gmap_data, 'place_id')
                ]);

                $this->notify([
                    'type'  => 'success',
                    'title' => 'Dirección actualizada con éxito'
                ]);

            } else {
                $address = UserAddress::create([
                    'user_id'         => Auth::id(),
                    'province_id'     => $this->form->province_id,
                    'locality_id'     => $this->form->locality_id,
                    'tag'             => $this->form->tag,
                    'zipcode'         => $this->form->zipcode,
                    'street'          => $this->form->street,
                    'number'          => $this->form->number,
                    'floor'           => $this->form->floor,
                    'apartment'       => $this->form->apartment,
                    'office'          => $this->form->office,
                    'details'         => $this->form->details,
                    'lat'             => data_get($this->form->gmap_data, 'geometry.location.lat'),
                    'lng'             => data_get($this->form->gmap_data, 'geometry.location.lng'),
                    'google_place_id' => data_get($this->form->gmap_data, 'place_id')
                ]);

                if (Auth::guest())
                {
                    if (session('guest_customer.id'))
                    {
                        $address->update(['user_id' => session('guest_customer.id')]);
                    }

                    session()->push('guest_customer.addresses', $address);
                }

                $this->notify([
                    'type'  => 'success',
                    'title' => 'Dirección creada con éxito'
                ]);

                $this->dispatch('new-address-created', $address->id);
            }

            $this->form->reset();

            $this->dispatch('close-new-address-panel');

        } catch (\Throwable $err) 
        {
            Log::channel('error')->error('Error al crear dirección', [
                'message'   => $err->getMessage(),
                'form_data' => $this->form->all()
            ]);

            $this->notify([
                'type'  => 'danger',
                'title' => 'Error al crear la dirección',
                'body'  => 'Por favor intentelo de nuevo más tarde'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.ecommerce.new-address-panel', [
            'provinces' => Province::orderBy('name')->get(),
            'localities' => $this->form->province_id ? Province::find($this->form->province_id)->localities()->orderBy('name')->get() : []
        ]);
    }
}
