<?php
/**
 * Created by PhpStorm.
 * domain: domain
 * Date: 9/3/2019
 * Time: 3:12 AM
 */

namespace App\Repositories;


use App\Domain;
use App\Interfaces\DomainRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class DomainRepository implements DomainRepositoryInterface
{
    private $domain;

    /**
     * domainRepository constructor.
     * @param Domain $domain $domain
     */
    public function __construct(Domain $domain)
    {
        $this->domain = $domain;
    }

    public function get($id)
    {
        return $this->domain::findOrFail($id);
    }

    public function all($request)
    {
        isset($request['columns']) && !empty($request['columns']) ?
            $domain = $this->domain::SelectFields($request['columns'])
            : $domain = $this->domain::query();
        return $domain->sortable()->paginate(5);
    }
    public function create($attr)
    {
        $attr['password'] = $this->generatePassword($attr['password']);
        return $this->domain::create($attr);
    }

    public function update($attr, $id)
    {
        $attr['password'] = $this->generatePassword($attr['password']);
        $this->domain::findOrFail($id)->update($attr);
    }

    public function delete($id)
    {
        $this->domain::findOrFail($id)->update(['is_deleted'=>'1']);
    }

    public function generatePassword($password){
        return bcrypt($password);
    }

    public function getAllItems()
    {
        return $this->domain->where('user_id',Auth::id())->paginate(1);
    }

    public function getItem($id)
    {
        // TODO: Implement getItem() method.
    }
}