<?php

namespace App\GraphQL\Mutations\Student;

use App\Models\User;
use App\Models\Student;
use App\Models\Guardian;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class CreateStudentMutator
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
        $userData =$args['studentUser'];
        $StudentData =  $args['student'];
        $file = $StudentData['photo'];
     
        

        if($file == null){
            
            // check if guardian exist
            $guardian = Guardian::where('email', $StudentData['guardian_email'])->first();
            if($guardian){
                $user = User::create([
                    'email' => $userData['email'],
                    'state_id'=> $userData['state'],
                    'city_id'=> $userData['city'],
                    'country_id'=> $userData['country'],
                    'blood_group_id'=> $userData['bloodGroup'],
                    'lga'=> $userData['lga'],
                    'user_type' => 'student',
                    'religion'=> $userData['religion'],
                    'password'=> Hash::make('destiny12'),
                    'first_name'=> $StudentData['first_name'],
                ]);
                $user->assignRole(7);

                $student = Student::create([
                'first_name'=> $StudentData['first_name'],
                'last_name'=> $StudentData['last_name'],
                'middle_name'=> $StudentData['middle_name'],
                'phone'=> $StudentData['phone'],
                'klase_id'=> $StudentData['klase'],
                'gender'=> $StudentData['gender'],
                'user_id' => $user->id,
                'address'=> $StudentData['address'],
                'guardian_name'=> $StudentData['guardian_name'],
                'guardian_no'=> $StudentData['guardian_no'],
                'guardian_email'=> $StudentData['guardian_email'],
                'guardian_address'=> $StudentData['guardian_address'],
                'code' => strtoupper(Str::random(8)),
                'birthday' => $StudentData['birthday'],  
                'slug'=> Str::slug($StudentData['first_name'].'-'.Str::random(8)),
                'adm_no' => $StudentData['adm_no'],
                'term'=> $StudentData['term'],
                'admitted_year'=> $StudentData['admitted_year'],
                'guardian_id' => $guardian->id,
                ]);
            }else{
                // if guardian does not exit, create guardian on user table
                $userGuardian= User::create([
                    'email' => $StudentData['guardian_email'],
                    'user_type' => 'guardian',
                    'password'=> Hash::make('destiny12'),
                    'first_name'=> $StudentData['guardian_name'],
                ]);

                $userGuardian->assignRole(8);
                
                // create guardian
                $guardianStudent = Guardian::create([
                    'slug'=> Str::slug($StudentData['guardian_name'].'-'.Str::random(8)),
                    'user_id' => $userGuardian->id,
                    'email'=> $StudentData['guardian_email'],
                ]);
            
        
                $user = User::create([
                    'email' => $userData['email'],
                    'state_id'=> $userData['state'],
                    'city_id'=> $userData['city'],
                    'country_id'=> $userData['country'],
                    'blood_group_id'=> $userData['bloodGroup'],
                    'lga'=> $userData['lga'],
                    'user_type' => 'student',
                    'religion'=> $userData['religion'],
                    'password'=> Hash::make('destiny12'),
                    'first_name'=> $StudentData['first_name'],
                ]);
                // assign role to student
                $user->assignRole(7);

                $student = Student::create([
                    'first_name'=> $StudentData['first_name'],
                    'last_name'=> $StudentData['last_name'],
                    'middle_name'=> $StudentData['middle_name'],
                    'phone'=> $StudentData['phone'],
                    'klase_id'=> $StudentData['klase'],
                    'gender'=> $StudentData['gender'],
                    'user_id' => $user->id,
                    'address'=> $StudentData['address'],
                    'guardian_name'=> $StudentData['guardian_name'],
                    'guardian_no'=> $StudentData['guardian_no'],
                    'guardian_email'=> $StudentData['guardian_email'],
                    'guardian_address'=> $StudentData['guardian_address'],
                    'code' => strtoupper(Str::random(8)),
                    'birthday' => $StudentData['birthday'],  
                    'slug'=> Str::slug($StudentData['first_name'].'-'.Str::random(8)),
                    'adm_no' => $StudentData['adm_no'],
                    'term'=> $StudentData['term'],
                    'admitted_year'=> $StudentData['admitted_year'],
                    'guardian_id' => $guardianStudent->id,
                ]);

            }


        }else{
             $name=  Str::random(4).$file->getClientOriginalName();
          
            $path = $file->storePubliclyAs('public/student',$name);
             $guardian = Guardian::where('email', $StudentData['guardian_email'])->first();
            if($guardian){
                    $user = User::create([
                    'email' => $userData['email'],
                    'state_id'=> $userData['state'],
                    'city_id'=> $userData['city'],
                    'country_id'=> $userData['country'],
                    'blood_group_id'=> $userData['bloodGroup'],
                    'lga'=> $userData['lga'],
                    'user_type' => 'student',
                    'religion'=> $userData['religion'],
                    'password'=> Hash::make('destiny12'),
                    'first_name'=> $StudentData['first_name'],
                ]);
                $user->assignRole(7);

                $student = Student::create([
                    'first_name'=> $StudentData['first_name'],
                    'last_name'=> $StudentData['last_name'],
                    'middle_name'=> $StudentData['middle_name'],
                    'phone'=> $StudentData['phone'],
                    'klase_id'=> $StudentData['klase'],
                    'gender'=> $StudentData['gender'],
                    'user_id' => $user->id,
                    'photo' => $name,
                    'address'=> $StudentData['address'],
                    'guardian_name'=> $StudentData['guardian_name'],
                    'guardian_no'=> $StudentData['guardian_no'],
                    'guardian_email'=> $StudentData['guardian_email'],
                    'guardian_address'=> $StudentData['guardian_address'],
                    'code' => strtoupper(Str::random(8)),
                    'birthday' => $StudentData['birthday'],  
                    'slug'=> Str::slug($StudentData['first_name'].'-'.Str::random(8)),
                    'adm_no' => $StudentData['adm_no'],
                    'term'=> $StudentData['term'],
                    'admitted_year'=> $StudentData['admitted_year'],
                    'guardian_id' => $guardian->id,
                ]);
            }else{
                $userGuardian= User::create([
                    'email' => $StudentData['guardian_email'],
                    'user_type' => 'guardian',
                    'password'=> Hash::make('destiny12'),
                    'first_name'=> $StudentData['guardian_name'],
                ]);
                $userGuardian->assignRole(8);
                $guardianStudent = Guardian::create([
                    'slug'=> Str::slug($StudentData['guardian_name'].'-'.Str::random(8)),
                    'user_id' => $userGuardian->id,
                    'email'=> $StudentData['guardian_email'],
                ]);

                $name=  Str::random(4).$file->getClientOriginalName();
                $path = $file->storePubliclyAs('public/student',$name);

                if($guardianStudent){
                    $user = User::create([
                        'email' => $userData['email'],
                        'state_id'=> $userData['state'],
                        'city_id'=> $userData['city'],
                        'country_id'=> $userData['country'],
                        'blood_group_id'=> $userData['bloodGroup'],
                        'lga'=> $userData['lga'],
                        'user_type' => 'student',
                        'religion'=> $userData['religion'],
                        'password'=> Hash::make('destiny12'),
                        'first_name'=> $StudentData['first_name'],
                    ]);
                    $user->assignRole(7);
                
                    $student = Student::create([
                        'first_name'=> $StudentData['first_name'],
                        'last_name'=> $StudentData['last_name'],
                        'middle_name'=> $StudentData['middle_name'],
                        'phone'=> $StudentData['phone'],
                        'klase_id'=> $StudentData['klase'],
                        'gender'=> $StudentData['gender'],
                        'user_id' => $user->id,
                        'photo' => $name,
                        'address'=> $StudentData['address'],
                        'guardian_name'=> $StudentData['guardian_name'],
                        'guardian_no'=> $StudentData['guardian_no'],
                        'guardian_email'=> $StudentData['guardian_email'],
                        'guardian_address'=> $StudentData['guardian_address'],
                        'code' => strtoupper(Str::random(8)),
                        'birthday' => $StudentData['birthday'],  
                        'slug'=> Str::slug($StudentData['first_name'].'-'.Str::random(8)),
                        'adm_no' => $StudentData['adm_no'],
                        'term'=> $StudentData['term'],
                        'admitted_year'=> $StudentData['admitted_year'],
                        'guardian_id' => $guardianStudent->id,
                    ]);
                }

            }

            
        }


        
    }
}
