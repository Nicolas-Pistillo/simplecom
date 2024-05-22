<div>
    <div x-data="{openNotification: false}" x-on:open-notification.window="openNotification = true">
        <x-toast ref="openNotification" :type="$type" :time="$time"
        :title="$title" :body="$body" :position="$position" :icon="$icon"
        />
    </div>
</div>
