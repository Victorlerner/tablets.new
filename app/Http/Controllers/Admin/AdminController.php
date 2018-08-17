<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    //
	/**
	 * @var
	 */
	protected $template;
	/**
	 * @var text
	 */
	protected $content = FALSE;
	/**
	 * @var
	 */
	protected $title;

	/**
	 * @var
	 */
	protected $vars;

	public function __construct() {


	}

	public function renderOutput() {
		$this->vars = array_add( $this->vars, 'title', $this->title );


		if ( $this->content ) {
			$this->vars = array_add( $this->vars, 'content', $this->content );
		}

		return view( $this->template )->with( $this->vars );


	}

	public function transliterate($string) {
		$str = mb_strtolower($string, 'UTF-8');

		$leter_array = array(
			'a' => 'а',
			'b' => 'б',
			'v' => 'в',
			'g' => 'г,ґ',
			'd' => 'д',
			'e' => 'е,є,э',
			'jo' => 'ё',
			'zh' => 'ж',
			'z' => 'з',
			'i' => 'и,і',
			'ji' => 'ї',
			'j' => 'й',
			'k' => 'к',
			'l' => 'л',
			'm' => 'м',
			'n' => 'н',
			'o' => 'о',
			'p' => 'п',
			'r' => 'р',
			's' => 'с',
			't' => 'т',
			'u' => 'у',
			'f' => 'ф',
			'kh' => 'х',
			'ts' => 'ц',
			'ch' => 'ч',
			'sh' => 'ш',
			'shch' => 'щ',
			'' => 'ъ',
			'y' => 'ы',
			'' => 'ь',
			'yu' => 'ю',
			'ya' => 'я',
		);

		foreach($leter_array as $leter => $kyr) {
			$kyr = explode(',',$kyr);

			$str = str_replace($kyr,$leter, $str);

		}

		//  A-Za-z0-9-
		$str = preg_replace('/(\s|[^A-Za-z0-9\-])+/','-',$str);

		$str = trim($str,'-');

		return $str;
	}

	public function buildTree( array $elements, int $parentId = 0){
		$branch = array();


		foreach ( $elements as $element ) {
			if ( !isset( $element['parent_id'] ) ) {

				foreach ( $element as $item ) {
					if ( $item['parent_id'] == $parentId ) {

						$children = $this->buildTree( $elements, $item['id'] );
						if ( $children ) {
							$item['children'] = $children;
						}
						$branch[] = $item;
					}
				}
			} else {
				if ( $element['parent_id'] == $parentId ) {
					$children = $this->buildTree( $elements, $element['id'] );
					if ( $children ) {
						$element['children'] = $children;
					}
					$branch[] = $element;
				}
			}
		}

		return $branch;
	}

	public function buildUlCheckboxOptions( array $tree, $category_id = null, int $Level = 0, $prev_id = 0 ) {

		$text = '';
		foreach ( $tree as $k => $item ) {
			$Level = $item['parent_id'] != 0 ? $Level : 0;

			$title = isset( $item['title'] ) ? $item['title'] : $item['alias'];
			if ( $prev_id['parent_id'] == 0 ) {
				$Level = 1;
			}


			$selected = '';
			if ( $category_id != null && in_array( $item['id'], $category_id ) ) {
				$selected = 'checked ';
			}


			if ( $item['parent_id'] != 0 ) {
				$text .=  '  <option value="' . $item['id'] .  '">'  . str_repeat('-',$Level) . $title .' </option>';

			} else {
				$text .=  '  <option value="' . $item['id'] .  '">'  . $title .' </option>';

			}

			//$Level = 0;
			if ( isset( $item['children'] ) ) {
				$text .= $this->buildUlCheckboxOptions( $item['children'], $category_id, $Level++ , $item );

			}

			$text .= "";

		}
		return $text . '';

	}

}
