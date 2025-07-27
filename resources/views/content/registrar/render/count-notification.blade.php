
<ul class="notification-drop my-auto" style="list-style: none;">
    <li class="item">
        <i class="fa fa-bell-o notification-bell" aria-hidden="true"></i>
        @if($count_unread > 0)
            <span class="btn__badge "> {{ $count_unread }}</span>
        @endif
        <ul style="list-style-type: none; border: 1px solid black; margin: 0; height: 226px; overflow: auto;">
            <li  class="p-2" style="margin-left: -32px; font-size: 0.9rem; border-bottom: 1px solid #dee2e6; margin-bottom: 5px;">
                Notifications
            </li>
            @if(count($notifications) > 0)

                @foreach ($notifications as $item)
                    <li class="p-2" style="margin-left: -32px" onclick="showNotif({{ $item->id }})">
                        <div style="font-size: 12px; font-weight: bold">
                            <div class="d-flex justify-content-between">
                                <div>
                                    {{ ucwords($item->type) }}
                                </div>
                                <div>
                                    @php
                                        $color = '#f00';
                                        if($item->read) {
                                            $color = 'none';
                                        }
                                    @endphp
                                    <div style="background: {{ $color }}; width: 10px;height: 10px; border-radius: 50%;"></div>
                                </div>
                            </div>
                        </div>
                        <div style="font-size: 12px;">
                            @php
                                $data = json_decode($item->data);
                                $message = $data->message;
                            @endphp
                            {{ $message }}
                        </div>
                        <div style="font-size: 8px; text-align:right; margin-top: 5px; color:rgb(97, 97, 97)">
                            {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                        </div>
                        <hr style="margin-bottom: 0;">
                    </li>
                @endforeach
            @else
                <li>No notifications</li>
            @endif

        </ul>
    </li>
</ul>

<script>

    $(document).ready(function() {
            $(".notification-drop .item").on('click', function() {
                $(this).find('ul').toggle();
            });
        });
</script>
