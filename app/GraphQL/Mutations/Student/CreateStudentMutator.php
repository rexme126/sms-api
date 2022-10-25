<?php

namespace App\GraphQL\Mutations\Student;

use App\Models\User;
use App\Models\Student;
use App\Models\Guardian;
use App\Models\Role;
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
        $userData = $args['studentUser'];
        $StudentData =  $args['student'];
        $file = $StudentData['photo'];


        if ($file == null) {

            // check if guardian exist
            $guardian = Guardian::where([
                'workspace_id' => $args['workspaceId'],
                'email' => $StudentData['guardian_email']
            ])->first();
            if ($guardian) {
                $user = User::create([
                    'email' => $userData['email'],
                    'state_id' => $userData['state'],
                    'city' => $userData['city'],
                    'country_id' => $userData['country'],
                    'blood_group_id' => $userData['bloodGroup'],
                    'lga' => $userData['lga'],
                    'user_type' => 'student',
                    'religion' => $userData['religion'],
                    'password' => Hash::make('school'),
                    'first_name' => $StudentData['first_name'],
                    'workspace_id' => $args['workspaceId']
                ]);
                $role = Role::where('name', 'student')->first();
                $user->assignRole($role->name);

                $student = Student::create([
                    'first_name' => $StudentData['first_name'],
                    'last_name' => $StudentData['last_name'],
                    'middle_name' => $StudentData['middle_name'],
                    'phone' => $StudentData['phone'],
                    'klase_id' => $StudentData['klase'],
                    'gender' => $StudentData['gender'],
                    'user_id' => $user->id,
                    'address' => $StudentData['address'],
                    'guardian_name' => $StudentData['guardian_name'],
                    'guardian_no' => $StudentData['guardian_no'],
                    'guardian_email' => $StudentData['guardian_email'],
                    'guardian_address' => $StudentData['guardian_address'],
                    'code' => strtoupper(Str::random(8)),
                    'birthday' => $StudentData['birthday'],
                    'slug' => Str::slug($StudentData['first_name'] . '-' . Str::random(8)),
                    'adm_no' => $StudentData['adm_no'],
                    'term_id' => $StudentData['term'],
                    'section_id' => $StudentData['section'],
                    'session_id' => $StudentData['session'],
                    'admitted_year' => $StudentData['admitted_year'],
                    'guardian_id' => $guardian->id,
                    'workspace_id' => $args['workspaceId']
                ]);
            } else {
                // if guardian does not exit, create guardian on user table
                $userGuardian = User::create([
                    'email' => $StudentData['guardian_email'],
                    'user_type' => 'guardian',
                    'password' => Hash::make('school'),
                    'first_name' => $StudentData['guardian_name'],
                    'workspace_id' => $args['workspaceId']
                ]);
                $guardianRole = Role::where('name', 'guardian')->first();
                $userGuardian->assignRole($guardianRole->name);

                // create guardian
                $guardianStudent = Guardian::create([
                    'slug' => Str::slug($StudentData['guardian_name'] . '-' . Str::random(8)),
                    'user_id' => $userGuardian->id,
                    'email' => $StudentData['guardian_email'],
                    'workspace_id' => $args['workspaceId']
                ]);


                $user = User::create([
                    'email' => $userData['email'],
                    'state_id' => $userData['state'],
                    'city' => $userData['city'],
                    'country_id' => $userData['country'],
                    'blood_group_id' => $userData['bloodGroup'],
                    'lga' => $userData['lga'],
                    'user_type' => 'student',
                    'religion' => $userData['religion'],
                    'password' => Hash::make('school'),
                    'first_name' => $StudentData['first_name'],
                    'workspace_id' => $args['workspaceId']
                ]);
                // assign role to student
                $role = Role::where('name', 'student')->first();
                $user->assignRole($role->name);

                $student = Student::create([
                    'first_name' => $StudentData['first_name'],
                    'last_name' => $StudentData['last_name'],
                    'middle_name' => $StudentData['middle_name'],
                    'phone' => $StudentData['phone'],
                    'klase_id' => $StudentData['klase'],
                    'gender' => $StudentData['gender'],
                    'user_id' => $user->id,
                    'address' => $StudentData['address'],
                    'guardian_name' => $StudentData['guardian_name'],
                    'guardian_no' => $StudentData['guardian_no'],
                    'guardian_email' => $StudentData['guardian_email'],
                    'guardian_address' => $StudentData['guardian_address'],
                    'code' => strtoupper(Str::random(8)),
                    'birthday' => $StudentData['birthday'],
                    'slug' => Str::slug($StudentData['first_name'] . '-' . Str::random(8)),
                    'adm_no' => $StudentData['adm_no'],
                    'term_id' => $StudentData['term'],
                    'section_id' => $StudentData['section'],
                    'session_id' => $StudentData['session'],
                    'admitted_year' => $StudentData['admitted_year'],
                    'guardian_id' => $guardianStudent->id,
                    'workspace_id' => $args['workspaceId']
                ]);
            }
        } else {
            $name =  Str::random(4) . $file->getClientOriginalName();

            $path = $file->storePubliclyAs('public/' . $args['workspaceId'] . '/students', $name);
            $guardian = Guardian::where([
                'workspace_id' => $args['workspaceId'],
                'email' => $StudentData['guardian_email']
            ])->first();
            if ($guardian) {
                $user = User::create([
                    'email' => $userData['email'],
                    'state_id' => $userData['state'],
                    'city' => $userData['city'],
                    'country_id' => $userData['country'],
                    'blood_group_id' => $userData['bloodGroup'],
                    'lga' => $userData['lga'],
                    'user_type' => 'student',
                    'religion' => $userData['religion'],
                    'password' => Hash::make('school'),
                    'first_name' => $StudentData['first_name'],
                    'workspace_id' => $args['workspaceId']
                ]);
                $role = Role::where('name', 'student')->first();
                $user->assignRole($role->name);

                $student = Student::create([
                    'first_name' => $StudentData['first_name'],
                    'last_name' => $StudentData['last_name'],
                    'middle_name' => $StudentData['middle_name'],
                    'phone' => $StudentData['phone'],
                    'klase_id' => $StudentData['klase'],
                    'gender' => $StudentData['gender'],
                    'user_id' => $user->id,
                    'photo' => $name,
                    'address' => $StudentData['address'],
                    'guardian_name' => $StudentData['guardian_name'],
                    'guardian_no' => $StudentData['guardian_no'],
                    'guardian_email' => $StudentData['guardian_email'],
                    'guardian_address' => $StudentData['guardian_address'],
                    'code' => strtoupper(Str::random(8)),
                    'birthday' => $StudentData['birthday'],
                    'slug' => Str::slug($StudentData['first_name'] . '-' . Str::random(8)),
                    'adm_no' => $StudentData['adm_no'],
                    'term_id' => $StudentData['term'],
                    'section_id' => $StudentData['section'],
                    'session_id' => $StudentData['session'],
                    'admitted_year' => $StudentData['admitted_year'],
                    'guardian_id' => $guardian->id,
                    'workspace_id' => $args['workspaceId']
                ]);
            } else {
                $userGuardian = User::create([
                    'email' => $StudentData['guardian_email'],
                    'user_type' => 'guardian',
                    'password' => Hash::make('school'),
                    'first_name' => $StudentData['guardian_name'],
                    'workspace_id' => $args['workspaceId']
                ]);

                $guardianRole = Role::where('name', 'guardian')->first();
                $userGuardian->assignRole($guardianRole->name);

                $guardianStudent = Guardian::create([
                    'slug' => Str::slug($StudentData['guardian_name'] . '-' . Str::random(8)),
                    'user_id' => $userGuardian->id,
                    'email' => $StudentData['guardian_email'],
                    'workspace_id' => $args['workspaceId']
                ]);

                $name =  Str::random(4) . $file->getClientOriginalName();
                $path = $file->storePubliclyAs('public/' . $args['workspaceId'] . '/students', $name);

                if ($guardianStudent) {
                    $user = User::create([
                        'email' => $userData['email'],
                        'state_id' => $userData['state'],
                        'city' => $userData['city'],
                        'country_id' => $userData['country'],
                        'blood_group_id' => $userData['bloodGroup'],
                        'lga' => $userData['lga'],
                        'user_type' => 'student',
                        'religion' => $userData['religion'],
                        'password' => Hash::make('school'),
                        'first_name' => $StudentData['first_name'],
                        'workspace_id' => $args['workspaceId']
                    ]);
                    $role = Role::where('name', 'student')->first();
                    $user->assignRole($role->name);

                    $student = Student::create([
                        'first_name' => $StudentData['first_name'],
                        'last_name' => $StudentData['last_name'],
                        'middle_name' => $StudentData['middle_name'],
                        'phone' => $StudentData['phone'],
                        'klase_id' => $StudentData['klase'],
                        'gender' => $StudentData['gender'],
                        'user_id' => $user->id,
                        'photo' => $name,
                        'address' => $StudentData['address'],
                        'guardian_name' => $StudentData['guardian_name'],
                        'guardian_no' => $StudentData['guardian_no'],
                        'guardian_email' => $StudentData['guardian_email'],
                        'guardian_address' => $StudentData['guardian_address'],
                        'code' => strtoupper(Str::random(8)),
                        'birthday' => $StudentData['birthday'],
                        'slug' => Str::slug($StudentData['first_name'] . '-' . Str::random(8)),
                        'adm_no' => $StudentData['adm_no'],
                        'term_id' => $StudentData['term'],
                        'section_id' => $StudentData['section'],
                        'session_id' => $StudentData['session'],
                        'admitted_year' => $StudentData['admitted_year'],
                        'guardian_id' => $guardianStudent->id,
                        'workspace_id' => $args['workspaceId']
                    ]);
                }
            }
        }
    }
}
