<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Manufacture;
use App\Tablet;
use Illuminate\Http\Request;
use Image;
use Validator;

class AddController extends AdminController {
	public function __construct() {
		$this->template = 'add-tablets';
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//

		$this->title = 'Add tablets';

		$categories = Category::get()->groupBy( 'parent_id' );
		$category_list = $this->buildUlCheckboxOptions( $this->buildTree( $categories->toArray(), 0 ) );


		$manufacturer = Manufacture::get();
		$this->vars = array_add( $this->vars, 'category_list', $category_list );
		$this->vars = array_add( $this->vars, 'manufactures', $manufacturer );


		return $this->renderOutput();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store( Tablet $tablet, Request $request ) {


		//
		$data = $request->except( '_token', 'image' );

		$validator = Validator::make( $data, [

			'title' => 'string|required',
			'alias' => 'string|required|unique:tablets|max:255',
			'description' => 'string|required',
			'manufacture_id' => 'required',
			'category_id' => 'required',


		], [
			'category_id.required' => 'Select manufacture ',
			'manufacture_id.required' => 'Select category '
		] );

		/**
		 * upload image
		 */

		if ( $request->hasFile( 'image' ) ) {
			$image = $request->file( 'image' );


			if ( $image->isValid() ) {

				$dir = public_path() . '/uploads/' . date( 'Y/m/d', time() ) . '/';

				// check if $folder is a directory
				if ( !\File::isDirectory( $dir ) ) {

					\File::makeDirectory( $dir, 493, true );
				}

				$original_name = trim( str_replace( ' ', '-', $image->getClientOriginalName() ) );

				$path = $dir . $image->getClientOriginalName();


				$watermark = Image::make( public_path( 'watermark.png' ) );

				$img_big = Image::make( $image );
				$img_big->insert( $watermark, 'center' );
				$img_big->insert( public_path( 'watermark.png' ), 'bottom-right', 10, 10 );
				$img_big->save( $path );
				$data['img'] = url( str_replace(public_path(),'',$path) );

			}
		}


		if ( $validator->fails() ) {
			return \Response::json( [ 'error' => $validator->errors()->all() ] );
		}

		$data['img'] = $data['img'] ?? '';


		if ( $tablet->where( 'alias', $data['alias'] )->first() ) {
			$request->merge( array( 'alias' => $data['alias'] ) );
			$request->flash();
			return \Response::json( [ 'error' => [ __( 'this alias is already used' ) ] ] );

		}


		$tablet->fill( $data );


		if ( $request->user()->tablet()->save( $tablet ) ) {
			return \Response::json( [ 'status' => $tablet->title . __( ' added!' ), 'img'  => $data['img']] );

		} else {
			return \Response::json( [ 'error' => [ __( 'an error occurred' ) ] ] );

		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show( $id ) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, $id ) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		//
	}
}
