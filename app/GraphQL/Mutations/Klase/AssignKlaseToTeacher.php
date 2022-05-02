<?php

namespace App\GraphQL\Mutations\Klase;

use App\Models\Klase;

final class AssignKlaseToTeacher
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        if(isset($args['klase'])){
            $klaseId = $args['klase'];
            $teachers = $args['teacher'];
            $klase = Klase::where('id', $klaseId)->first();
            $klase->teachers()->sync($teachers);
            return $klase;
        }
        if(isset($args['id'])){
            $id= $args['id'];
             $klase = Klase::where('id', $id)->first();

            $deleteKlaseTeachers = $klase->teachers;
             foreach ($deleteKlaseTeachers as $key => $value) {
                 $klase->teachers()->toggle($value->id);
             }
             $klase->delete();
        }
  
    }
}
