<?php
 
namespace App\Core\Services;


use App\Core\Interfaces\UserInterface;
use App\Core\Interfaces\ScholarsInterface;
use App\Core\BaseClasses\BaseService;
use App\Models\Pap;
use App\Models\Scholars;


class HomeService extends BaseService{



    protected $user_repo;


    public function __construct(UserInterface $user_repo){

        $this->user_repo = $user_repo;
        parent::__construct();

    }



}