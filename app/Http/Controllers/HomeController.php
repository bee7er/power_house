<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Guard;

use App\Notice;
use App\Resource;
use App\Template;
use Illuminate\Http\Request;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
	const ABOUT_TEMPLATE = '*About';
	const LOGOS_TEMPLATE = '*Logos';
	const CONTACT_TEMPLATE = '*Contact';

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function index(Request $request)
	{
		$builder = Resource::select(
			array(
				'resources.id',
				'resources.name',
				'resources.description',
				'resources.titleThumb',
				'resources.titleThumbHover',
				'resources.useTitleThumbOnly',
				'resources.thumb',
				'resources.thumbHover',
				'resources.useThumbHover',
				'resources.isClickable',
				'resources.includeInAll',
				'resources.isAnimator',
				'resources.isDirector',
				'resources.isPersonal',
				'resources.isCommercial',
				'resources.type',
				'resources.seq',
				'resources.deleted_at'
			)
		)
			->orderBy("resources.seq")
			->limit(999);

		$resources = $builder->get();

		if ($resources->count() > 0) {
			// Derive the hover title image for each remaining entry and add it to the object
			foreach ($resources as &$resource) {
				// Grab the first entry, it is the title entry
				$titleResource = $resources->first();
				// If we are to use the hover then generate the necessary HTML
				$resource->hoverActions = '';
				if ($resource->useThumbHover) {
					$resource->hoverActions = sprintf('onmouseover="this.src=\'%s\'" onmouseout="this.src=\'%s\'"',
						$resource->thumbHover, $resource->thumb);
				}
				// Check if the thumb is in fact a video
				$resource->video = '';
				if (false !== strpos($resource->thumb, '.mp4')) {
					$resource->video = $resource->thumb;
				}
				// Check if the thumb is clickable
				$resource->clickAction = $resource->clickActionClass = '';
				if ($resource->isClickable) {
					$resource->clickAction = 'onclick="document.location=\'' . url($resource->name) .'\';"';
					$resource->clickActionClass = 'work-image-clickable';
				}
			}

			// Not doing the following check as we now have entriesd which are used for the title only
			// This makes the logic here tricky and is bound to cause problems
			// Admin should ensure there are an even number of entries instead

//			// Make sure we have an even number of entries, which is a factor of 3
//			$count = $resources->count();
//
//			$first = null;
//			$useImage = 0;
//			while (($count % 3) !== 0) {
//				$use = clone($resources->get($useImage));
//				$use['id'] = (9999 + $useImage);        // Dummy unique id
//				$resources = $resources->merge([$use]);
//				$count = $resources->count();
//				$useImage++;
//			}
		}

		$notices = Notice::select(
			array(
				'notices.id',
				'notices.seq',
				'notices.notice',
				'notices.url',
				'notices.deleted_at'
			)
		)
			->orderBy("notices.seq")
			->limit(999)->get();

		$about = Template::where([ 'name' => self::ABOUT_TEMPLATE, 'deleted_at' => null ])->get()->first();
		$aboutText = $about ? $about->container: null;

		$logos = Template::where([ 'name' => self::LOGOS_TEMPLATE, 'deleted_at' => null ])->get()->first();
		$logosText = $logos ? $logos->container: null;

		$contact = Template::where([ 'name' => self::CONTACT_TEMPLATE, 'deleted_at' => null ])->get()->first();
		$contactText = $contact ? $contact->container: null;

		$loggedIn = false;
		if ($this->auth->check()) {
			$loggedIn = true;
		}

		return view('pages.home', compact('resources', 'titleResource', 'aboutText', 'logosText', 'contactText', 'notices', 'loggedIn'));
	}

}
