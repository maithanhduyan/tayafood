<?php
namespace Laraviet\BookCRUD\Controllers;

use Illuminate\Http\Request;
use Laraviet\BookCRUD\Requests\EditBookRequest;
use Laraviet\BookCRUD\Services\BookServiceContract;
use Laraviet\BookCRUD\Requests\CreateBookRequest;
use App\Http\Controllers\Controller;

class BooksController extends Controller
{
    protected $service;
    public function __construct(BookServiceContract $service)
    {
        $this->service = $service;
    }
    public function index()
    {
        $items = $this->service->paginate();
        return view('book-crud::books.index', compact("items"));
    }
    public function create()
    {
        return view('book-crud::books.create');
    }
    public function store(CreateBookRequest $request)
    {
        $this->service->store($request->all());
        return redirect()->route('books.index');
    }
    public function show($id)
    {
        $item = $this->service->find($id);
        return view('book-crud::books.show', compact('item'));
    }
    public function edit($id)
    {
        $item = $this->service->find($id);
        return view('book-crud::books.edit', compact('item'));
    }
    public function update(EditBookRequest $request, $id)
    {
        $this->service->update($id, $request->all());
        return redirect()->route('books.index');
    }
    public function destroy($id)
    {
        $this->service->destroy($id);
        return redirect()->route('books.index');
    }
}
