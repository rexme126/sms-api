<?php

namespace App\GraphQL\Mutations\Student;

use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class UpdateStudentMutator
{
    /**
     * Return a value for the field.
     *
     * @param  @param  null  $root Always null, since this field has no parent.
     * @param  array{}  $args The field arguments passed by the client.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Shared between all fields.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Metadata for advanced query resolution.
     * @return mixed
     */
    public function __invoke($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $id= $args['id'];
        $userData =$args['studentUser'];
        $StudentData =  $args['student'];
        $file = $StudentData['image'];
      
        //    student
        $student = Student::where('id', $id)->first();
        $userId = $student->user_id;
        $user = User::where('id', $userId)->first();
        

     if($file != null){
            $name=  Str::random(4).$file->getClientOriginalName();
            $path = $file->storePubliclyAs('public/student', $name);
            Storage::delete('public/student/'.$student->photo);

            $student->first_name = $StudentData['first_name'];
            $student->last_name = $StudentData['last_name'];
            $student->middle_name = $StudentData['middle_name'];
            $student->birthday = $StudentData['birthday'];
            $student->phone = $StudentData['phone'];
            $student->photo = $name;
            $student->klase_id = $StudentData['klase'];
            $student->gender = $StudentData['gender'];
            $student->address = $StudentData['address'];
            $student->guardian_name = $StudentData['guardian_name'];
            $student->guardian_no = $StudentData['guardian_no'];
            $student->guardian_email = $StudentData['guardian_email'];
            $student->guardian_address = $StudentData['guardian_address'];
            $student->term = $StudentData['term'];
            $student->admitted_year = $StudentData['admitted_year'];


            // user data

            $user->state_id = $userData['state'];
            $user->country_id = $userData['country'];
            $user->blood_group_id = $userData['bloodGroup'];
            $user->city_id = $userData['city'];
            $user->lga = $userData['lga'];
            $user->email = $userData['email'];
            $user->religion = $userData['religion'];

            $user->save();
            $student->save();
            return $student;
          
        
        }else{
            $student->first_name = $StudentData['first_name'];
            $student->last_name = $StudentData['last_name'];
            $student->middle_name = $StudentData['middle_name'];
            $student->birthday = $StudentData['birthday'];
            $student->phone = $StudentData['phone'];
            $student->klase_id = $StudentData['klase'];
            $student->gender = $StudentData['gender'];
            $student->address = $StudentData['address'];
            $student->guardian_name = $StudentData['guardian_name'];
            $student->guardian_no = $StudentData['guardian_no'];
            $student->guardian_email = $StudentData['guardian_email'];
            $student->guardian_address = $StudentData['guardian_address'];
            $student->term = $StudentData['term'];
            $student->admitted_year = $StudentData['admitted_year'];

            // user data
        
            $user->state_id = $userData['state'];
            $user->country_id = $userData['country'];
            $user->blood_group_id = $userData['bloodGroup'];
            $user->city_id = $userData['city'];
            $user->lga = $userData['lga'];
            $user->email = $userData['email'];
            $user->religion = $userData['religion'];
     
            $user->save();
            $student->save();
            return $student;
            
        }
      
    }
}
