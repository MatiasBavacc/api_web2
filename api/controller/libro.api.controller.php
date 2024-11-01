<?php
    require './api/model/libro.model.php';
    require './api/view/json.view.php';
    class LibroApiController{
        private $model;
        private $view;

        public function __construct(){
            $this->model = new LibroModel();
            $this->view = new JSONView();
        }

        public function getAll($request, $response){
            $orderBy = false;
            $id_libreria = false;

            if(isset($request->getQuery()->id_libreria)){
                $id_libreria = $request->getQuery()->id_libreria;
            }

            if(isset($request->getQuery()->orderBy)){
                $orderBy = $request->getQuery()->orderBy;

                $books = $this->model->getBooks($id_libreria, $orderBy);
            }else{
                $books = $this->model->getBooks();
            }
            return $this->view->response($books);
        }

        public function get($request, $response){
            $id = $request->getParams()->id;
            $book = $this->model->getBook($id);
            
            if($book){
                return $this->view->response($book);
            }
            return $this->view->response("El libro con el id $id no existe", 404);
        }

        public function delete($request, $response){
            $id = $request->getParams()->id;
            $book = $this->model->getBook($id);
            if($book){
                $this->model->deleteBook($id);
                return $this->view->response("El libro con el id $id se elimino con exito.");
            }
            return $this->view->response("El libro con el id $id no existe", 404);
        }

        public function create($request, $response){
            $idAnterior = $this->model->getLastId();//Para verificar si agrega...

            $newBook = $request->getBody();
            if( empty($newBook->nombre_libro) || empty($newBook->id_libreria) ||
                empty($newBook->genero) || empty($newBook->editorial)
            ){
                return $this->view->response("Faltan completar datos", 400);
            }
            
            
            $nombre = $newBook->nombre_libro;
            $genero = $newBook->genero;
            $editorial = $newBook->editorial;
            $id_libreria = $newBook->id_libreria;
            $this->model->addBook($nombre,$genero,$editorial,$id_libreria);

            $idActual = $this->model->getLastId();//Para verificar si agrego...
            if($idAnterior<$idActual){
                $book = $this->model->getBook($idActual);//Busco el libro insertado para retornarlo.
                return $this->view->response($book, 201);
            }
            return $this->view->response("Ocurrio un problema al agregar el libro '$nombre'", 500);
        }

        public function update($request, $response){
            $id = $request->getParams()->id;
            $book = $this->model->getBook($id);
            
            if(!$book){
                return $this->view->response("El libro con el id $id no existe", 404);
            }
            $newBook = $request->getBody();
            if( empty($newBook->nombre_libro) || empty($newBook->id_libreria) ||
                empty($newBook->genero) || empty($newBook->editorial)
            ){
                return $this->view->response("Faltan completar datos", 400);
            }
            
            
            $nombre = $newBook->nombre_libro;
            $genero = $newBook->genero;
            $editorial = $newBook->editorial;
            $id_libreria = $newBook->id_libreria;
            $this->model->setBook($id,$nombre,$genero,$editorial,$id_libreria);

            $book = $this->model->getBook($id);
            if(! $nombre == $book->nombre_libro && 
                $genero == $book->genero &&
                $editorial == $book->editorial &&
                $id_libreria == $book->id_libreria ){

                return $this->view->response("Ocurrio un problema al modificar el libro '$nombre'", 500);
            }

            return $this->view->response($book, 200);

        }

    }