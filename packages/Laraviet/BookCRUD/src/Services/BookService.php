<?php
namespace Laraviet\BookCRUD\Services;

use Laraviet\BookCRUD\Repositories\BookRepositoryContract;

class BookService implements BookServiceContract
{
    protected $repository;
    public function __construct(BookRepositoryContract $repository)
    {
        return $this->repository = $repository;
    }
    public function paginate()
    {
        return $this->repository->paginate();
    }
    public function find($id)
    {
        return $this->repository->find($id);
    }
    public function store($data)
    {
        return $this->repository->store($data);
    }
    public function update($id, $data)
    {
        return $this->repository->update($id, $data);
    }
    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}
