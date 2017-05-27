<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Redscribble
 * @author     sugar lead <anjakahuy@gmail.com>
 * @copyright  2017 sugar lead
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
if(!defined('DS')) define('DS', DIRECTORY_SEPARATOR);
// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Document controller class.
 *
 * @since  1.6
 */
class RedscribbleControllerDocument extends JControllerForm
{
	/**
	 * Constructor
	 *
	 * @throws Exception
	 */
	public function __construct()
	{
		$this->view_list = 'documents';
		parent::__construct();
	}
	  function save(){
        // ---------------------------- Uploading the file ---------------------
        // Neccesary libraries and variables
        jimport( 'joomla.filesystem.folder' );
        jimport('joomla.filesystem.file');
        $data = JRequest::getVar( 'jform', null, 'post', 'array' );

        // Create the redscribble folder if not exists in images folder
        if ( !JFolder::exists( JPATH_SITE . DS . "images" . DS . "redscribble" ) ) {
            JFolder::create( JPATH_SITE . DS . "images" . DS . "redscribble" );
        }

        // Get the file data array from the request.
        $file = JRequest::getVar( 'jform', null, 'files', 'array' );

        // Make the file name safe.
        $filename = JFile::makeSafe($file['name']['file']);

        // Move the uploaded file into a permanent location.
        if ( $filename != '' ) {
            // Make sure that the full file path is safe.
            $filepath = JPath::clean( JPATH_SITE . DS . 'images' . DS . 'redscribble' . DS . strtolower( $filename ) );

            // Move the uploaded file.
            JFile::upload( $file['tmp_name']['file'], $filepath );
            // Change $data['file'] value before save into the database 
            $data['file'] = strtolower( $filename );
        }
        // ---------------------------- File Upload Ends ------------------------

        JRequest::setVar('jform', $data );

        return parent::save();
    }
}
