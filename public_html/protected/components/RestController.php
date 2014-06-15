<?php
  
  abstract class RestController extends Controller
  {
    /**
     * Default response format
     */
    private $format = 'json';

    public function filters()
    {
      return array();
    }

    // actions
    abstract public function actionList();

    abstract public function actionView($id);

    abstract public function actionCreate();
    
    abstract public function actionUpdate($id);

    abstract public function actionDelete($id);

    protected function _sendResponse($status = 200, $body = '', $content_type = 'text/html')
    {
      // set status
      $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
      header($status_header);
      // set content type
      header('Content-type:' . $content_type);

      if ($body != '') {
        echo $body;
      } else {
        $message = '';

        switch ($status) {
          case 401:
            $message = 'You must be authorized to view this page';
            break;
          case 404:
            $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
            break;
          case 500:
            $message = 'The server encountered an error processing your request';
            break;
          case 501:
            $message = 'The requested method is not implemented';
            break;
        }
        $signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];
        
        $body = '
          <!doctype html>
          <html lang="en-US">
            <head>
              <meta charset="UTF-8">
              <title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
            </head>
            <body>
              <h1>' . $this->_getStatusCodeMessage($status) . '</h1>
              <p>' . $message . '</p>
              <hr />
              <address>' . $signature . '</address>
            </body>
          </html>';

        echo $body;
      }
      Yii::app()->end();
    }

    protected function _getStatusCodeMessage($status)
    {
      $codes = array(
        200 => 'OK',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        500 => 'Internal Server Error',
        501 => 'Not implemented',
      );

      return (isset($code[$status])) ? $codes[$status] : '';
    }
  }