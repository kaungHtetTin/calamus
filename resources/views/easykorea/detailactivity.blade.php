 
           
       <@php
        $lessonData=$lessonData->entry->content;
    
        foreach ($lessonData as $key => $value) {
           echo $value;
        }


    @endphp    
 