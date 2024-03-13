<?php

namespace App\Core\Interfaces;



interface AttributionsInterface {

    public function fetch($request);

    public function store($reques);

    public function update($request);

    public function destroy($slug);

    public function findBySlug($slug);

}