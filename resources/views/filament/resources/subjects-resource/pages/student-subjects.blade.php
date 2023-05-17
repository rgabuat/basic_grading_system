<x-filament::page>

<table class="w-full border-collapse border border-gray-400">
    <thead>
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b bg-gray-50">Student</th>
          
                @foreach($grading as $key => $gradingPeriod)
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b bg-gray-50">{{$gradingPeriod->name}}</th>
                @endforeach
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b bg-gray-50">Final Grade</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b bg-gray-50">Remarks</th>




        </tr>
    </thead>
    <tbody>
        @foreach ($students as $grade)
    <tr class="bg-gray-100 ">
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-b">{{$grade->fname}} {{$grade->lname}}</td>
        @php
            $finalGrade = 0;
        @endphp
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
