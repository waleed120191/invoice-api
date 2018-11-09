<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidateItems implements Rule
{
    protected $fail;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value) {

        $value = request()->all();


        if(!is_array($value['lines'])){
            $this->fail = 'Empty lines.' ;
            return FALSE;
        }

        foreach ($value['lines'] as $k => $v){

            if(empty($v['id']) OR !is_string($v['id'])){
                $this->fail = 'id at index '.$k.' is invalid.';
                return FALSE;
            }
            elseif( empty($v['quantity']) OR !is_numeric($v['quantity']) ){
                $this->fail = 'quantity at index '.$k.' is invalid.';
                return FALSE;
            }
            elseif( empty($v['discount']) OR !is_numeric($v['discount']) OR !( $v['discount'] > 0 && $v['discount'] < 51) ){
                $this->fail = 'discount at index '.$k.' is invalid.';
                return FALSE;
            }

        }

        return TRUE;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->fail;
    }
}
