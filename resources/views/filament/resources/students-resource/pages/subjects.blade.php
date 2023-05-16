<x-filament::page>

@if (session()->has('message'))
    <div class="px-4 py-2 mt-4 text-sm font-medium text-white bg-green-500">
        {{ session('message') }}
    </div>
@endif
    <button wire:click="sendEmail" wire:loading.attr="disabled" class="px-4 py-2 mt-4 text-sm font-medium text-white bg-gray-500 hover:bg-gray-600 rounded-md">
    <span wire:loading wire:target="sendEmail" class="mr-2">
        <i class="fa fa-spinner fa-spin"></i>
    </span>
    Send Email
</button>
<table class="w-full border-collapse border border-gray-400">
    <thead>
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b bg-gray-50">Subject</th>
           
                @foreach($gradingPeriod as $key => $grade)
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b bg-gray-50">{{$grade->name}}</th>
                @endforeach
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b bg-gray-50">Final Grade</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b bg-gray-50">Remarks</th>




        </tr>
    </thead>
    <tbody>
       @foreach ($subjects as $grade)
    <tr class="bg-gray-100 ">
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-b">{{$grade->name}}</td>
        @php
            $finalGrade = 0;
        @endphp
        @if (!empty($grade->gradingPeriod))
            @foreach($grade->gradingPeriod as $key => $gradingPeriod)
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-b">
                    {{$gradingPeriod->total * 100}}
                    @php
                        if($gradingPeriod->name == 'Prelim' || $gradingPeriod->name == 'Midterm'){
                            $percent = 30;
                        } else {
                            $percent = 40;
                        }

                        $finalGrade += ($gradingPeriod->total * 100) * ($percent / 100);
                    @endphp
                </td>
            @endforeach
        @endif
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-b">{{$finalGrade}}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-b">
            @if($finalGrade > 75 )
                Passed
            @else
                Failed
            @endif
        </td>
    </tr>
@endforeach

    </tbody>
</table>
</x-filament::page>
