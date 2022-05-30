<?php

namespace App\GraphQL\Mutations\Payment;

use App\Models\Payment;
use App\Models\Student;
use Illuminate\Support\Str;
use App\Models\PaymentRecord;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class CreatePaymentMutator
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
        $termId= $args['term_id'];
        $sessionId= $args['session_id'];
        $klase= $args['klase'];
        $amount= $args['amount'];
        $currentyear= now()->year;
    

        // first write to payment table
        
        
     
        $students= Student::where(['klase_id'=>$klase,'session_id'=>$sessionId])->get()->pluck('id');
        if(count($students)>0){

            $pa = PaymentRecord::where(['klase_id'=>$klase,'session_id'=>$sessionId,
            'term_id'=>$termId])->first();
        
            if($pa == null){
                $payment= Payment::create([
                'term_id'=> $termId,
                'session_id'=> $sessionId,
                'amount'=> $amount,
                'title'=> 'School Fee',
                'method'=> 'cash or online',
                'klase_id'=> $klase
            ]);
                $payment->save();
        
            }else {
                return;
            }
            
            foreach ($students as $student) {

                $a = PaymentRecord::where(['klase_id'=>$klase,'session_id'=>$sessionId,
                'student_id'=>$student,'term_id'=>$termId])->get();
                if(count($a) == 0){     
                        
                    // write to payment-record table
                    $paymentRecord= PaymentRecord::updateOrCreate([
                        'student_id'=> $student,
                        'payment_id'=> $payment->id,
                        'klase_id'=> $klase,
                        'term_id'=> $termId,
                        'session_id'=> $sessionId,
                        'amount'=> $amount,
                        'balance' =>$amount,
                        'ref_no' => strtoupper($currentyear.'/'.Str::random(10)),
                    ]);
                } else {
                    return;
                }  
            }
             

        }else{
            return;
        }
          
       return Payment::where(['klase_id'=>$klase,'session_id'=>$sessionId,
        'term_id'=>$termId])->first();
       
    }
}
