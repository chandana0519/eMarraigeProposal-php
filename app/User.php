<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use common;
use DateTime;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    protected $selectConstant = '  -- Please Select --  ';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'username','email','password','pswdhash','dateofbirth','sex','sex_id','country','country_id','title','description',
                    'maritalstatus_id','maritalstatus','height_id','height','weight_id','weight','kids_id','kids','smoking_id','smoking','drinking_id','drinking',
                    'body_type','appearance','living_with'
                ];
    //protected $guarded = ['username', 'email', 'password','pswdhash','country_id']; 

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'pswdhash','token','remember_token'];

    public function getMaritalstatusAttribute($value)
    {
        return $value==$this->selectConstant?"":$value;
    }

    public function getKidsAttribute($value)
    {
        return $value==$this->selectConstant?"":$value;
    }

    public function getSmokingAttribute($value)
    {
        return $value==$this->selectConstant?"":$value;
    }

    public function getDrinkingAttribute($value)
    {
        return $value==$this->selectConstant?"":$value;
    }

    public function getWorkAttribute($value)
    {
        return $value==$this->selectConstant?"":$value;
    }

    public function getEducationAttribute($value)
    {
        return $value==$this->selectConstant?"":$value;
    }

    public function getRelationshipAttribute($value)
    {
        return $value==$this->selectConstant?"":$value;
    }

    /**
     * Get the age of the user.
     */
    public function getAge()
    {
        return (new DateTime($this->dateofbirth))->diff(new DateTime())->y;
        //return $this->dateofbirth->diffInYears();        
    }

    /**
     * Get the apperence associated with the user.
     */
    public function getAppearance()
    {
        $val = "";
        if ($this->height_id>0) $val=$this->height.', ';
        if ($this->weight_id>0) $val=$val.$this->weight.', ';
        if (!common::IsNullOrEmptyString($this->body_type)) $val=$val.$this->body_type.', ';
        if (!common::IsNullOrEmptyString($this->appearance)) $val=$val.$this->appearance.', ';
        return common::ConcatDispay($val);
    }

     /**
     * Get the apperence associated with the user.
     */
    public function getLocation()
    {
        $val = "";
        if ($this->city_id>0) {
            $val=$this->city.', ';
        }elseif ($this->state_id>0) {
            $val=$this->state.', ';
        };
        if ($this->country_id>0) $val=$val.$this->country.', ';
        return common::ConcatDispay($val);
    }

    /**
     * Get the work/education details associated with the user.
     */
    public function getWorkEdu()
    {
        $val = "";
        if ($this->work_id>0) $val=$this->work.', ';
        if ($this->education_id>0) $val=$val.$this->education.', ';
        return common::ConcatDispay($val);
    }

    /**
     * Get the profile image associated with the user.
     */
    public function ProfileImage()
    {
        //return $this->hasOne('App\ProfileImage', 'id', 'profileimage_id');
    }

    /**
     * Get the online record associated with the user.
     */
    public function Online()
    {
        return $this->hasOne('App\OnlineUser');
    }

    /**
     * Get the profile images associated with the user.
     */
    public function Images()
    {
        return $this->hasMany('App\ProfileImage');
    }

    /**
     * Confirm the user.
     *
     * @return void
     */
    public function confirmEmail()
    {
        $this->email_verified = true;
        $this->token = null;

        $this->save();
    }

    /**
     * get personal info section completed percentage
     *
     * @return void
     */
    public function percentagePersonalInfo()
    {
        $completed=0;
        if(!empty($this->title) && trim($this->title)!="") $completed++;
        if(!empty($this->description) && !trim($this->description)=="") $completed++;
        if(!empty($this->maritalstatus_id)) $completed++;
        if(!empty($this->height_id)) $completed++;
        if(!empty($this->weight_id)) $completed++;
        if(!empty($this->body_type)) $completed++;
        if(!empty($this->appearance)) $completed++;
        if(!empty($this->living_with)) $completed++;
        if(!empty($this->kids_id)) $completed++;
        if(!empty($this->smoking_id)) $completed++;
        if(!empty($this->drinking_id)) $completed++;        
        return intval((100/11)*$completed);        
    }

    /**
     * get work education section completed percentage
     *
     * @return void
     */
    public function percentageWorkEducation()
    {
        $completed=0;
        if(!empty($this->work_id)) $completed++;
        if(!empty($this->education_id)) $completed++;
        return intval((100/2)*$completed);        
    }

    /**
     * get location residency section completed percentage
     *
     * @return void
     */
    public function percentageLocationResidency()
    {
        $completed=0;
        if(!empty($this->country_id)) $completed++;
        if(!empty($this->state_id)) $completed++;
        if(!empty($this->city_id)) $completed++;
        if(!empty($this->residency) && trim($this->residency)!="") $completed++;
        return intval((100/4)*$completed);        
    }
}
