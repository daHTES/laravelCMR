<?php


namespace App\Services\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait BaseSearch {

    protected function getObject(){

        $className = self::MODEL;
        return new $className;
    }

    protected function getNameSpace(){
        return (new \ReflectionObject($this))->getNamespaceName();
    }

    public function apply(Request $filters){
        $query = static::applyDecoratorsFromRequest($filters, $this->getObject()->newQuery());

        return static::getResults($query);
    }

    private function applyDecoratorsFromRequest(Request $request, Builder $query){

        foreach ($request->all() as $filterName =>  $value) {
            if(!$value){
                continue;
            }
            $decorator = $this->createFilterDecorator($filterName);
            if(static::isValidDecorator($decorator)){
                $query = $decorator::apply($query, $value);
            }
        }
    return $query;
    }

    protected function createFilterDecorator($name){
        return $this->getNameSpace() . "\\" . Str::studly($name);
    }

    protected function isValidDecorator($decorator){

        return class_exists($decorator);
    }

    protected function getResults(Builder $query){

        return $query;
    }

}
