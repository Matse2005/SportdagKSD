@php
    //  SHow if registrations are open
    $utc_start_datetime = strtotime(date('Y-m-d H:i', strtotime($settings['start_datetime']->value)));
    $utc_end_datetime = strtotime(date('Y-m-d H:i', strtotime($settings['end_datetime']->value)));
    
    $offset = date('Z');
    
    $local_start_datetime_timestamp = date('Y-m-d H:i', $utc_start_datetime + $offset);
    $local_end_datetime_timestamp = date('Y-m-d H:i', $utc_end_datetime + $offset);
    
    $local_start_datetime = strtotime($local_start_datetime_timestamp);
    $local_end_datetime = strtotime($local_end_datetime_timestamp);
    
    $current_datetime = strtotime(date('Y-m-d H:i'));
    
    // Countdown to the opening date
    $current_datetime < $local_start_datetime ? ($time_till = $local_start_datetime - $current_datetime) : ($time_till = $local_end_datetime - $local_start_datetime);
    
    $time_till_readable;
    // Convert the countdown to a readable format
    // Check if the coundown is in days
    if ($time_till >= 86400) {
        floor($time_till / 86400) == 1 ? ($time_till_readable = floor($time_till / 86400) . ' dag') : ($time_till_readable = floor($time_till / 86400) . ' dagen');
    }
    // Check if the coundown is in hours
    elseif ($time_till >= 3600) {
        $time_till_readable = floor($time_till / 3600) . ' uur';
    }
    // Check if the coundown is in minutes
    elseif ($time_till >= 60) {
        floor($time_till / 60) == 1 ? ($time_till_readable = floor($time_till / 60) . ' minuut') : ($time_till_readable = floor($time_till / 60) . ' minuten');
    } else {
        floor($time_till) == 1 ? ($time_till_readable = floor($time_till) . ' seconde') : ($time_till_readable = floor($time_till) . ' seconden');
    }
@endphp
<div class="w-full h-full bg-gray-900">
    <div class="flex items-center justify-center text-white bg-ksdGreen/50">
        <p class="px-4 py-3 text-xs tracking-widest text-center uppercase">
            @if ($current_datetime < $local_start_datetime)
                De inschrijvingen starten <br class="sm:hidden"> over <span
                    class="font-bold rounded-md sm:font-base sm:p-2 sm:bg-ksdGreen/75">{{ $time_till_readable }}</span>
            @elseif ($current_datetime > $local_end_datetime)
                De inschrijvingen zijn gesloten
            @else
                De inschrijvingen sluiten <br class="sm:hidden"> over <span
                    class="font-bold rounded-md sm:font-base sm:p-2 sm:bg-ksdGreen/75">{{ $time_till_readable }}</span>
            @endif
        </p>
    </div>
</div>
