<x-filament::page>

<table class="w-full border-collapse border border-gray-400">
    <thead>
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b bg-gray-50">Student</th>
             @foreach ($students as $grade)
                @foreach($grade->gradingPeriod as $key => $gradingPeriod)
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b bg-gray-50">{{$gradingPeriod->name}}</th>
                @endforeach
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b bg-gray-50">Final Grade</th>

            @endforeach


        </tr>
    </thead>
    <tbody>
        @foreach ($students as $grade)
        
        <tr class="@if($loop->odd) bg-gray-100 @endif">
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-b">{{$grade->fname}} {{$grade->lname}}</td>
            @foreach($grade->gradingPeriod as $key => $gradingPeriod)
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-b">{{$gradingPeriod->total*100}}</td>
            @endforeach
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-b">{{$grade->total}}</td>

        </tr>
        @endforeach
    </tbody>
</table>
</x-filament::page>