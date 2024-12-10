<?php
namespace App\Http\Controllers;

use App\Http\Requests\Youtube\StoreYoutubeRequest;
use App\Services\YouTubeService;
use App\Helper\Reply;
use Google_Client;
use Google_Service_YouTube;
use Google_Service_YouTubeAnalytics;
use Illuminate\Http\Request;
use App\Models\Youtube;
use Illuminate\Support\Facades\Storage;
use App\Helper\Files;

class YouTubeController extends AccountBaseController
{
    protected $youtubeService;

    public function __construct(YouTubeService $youtubeService)
    {
        parent::__construct();
        $this->pageTitle = 'app.menu.youtubes';
        $this->youtubeService = $youtubeService;
    }
    public function create()
    {
        $this->pageTitle = __('app.menu.addYoutube');

        $this->addPermission = user()->permission('add_product');
        abort_403(!in_array($this->addPermission, ['all', 'added']));

        $youtube = new Youtube();


        $getCustomFieldGroupsWithFields = $youtube->getCustomFieldGroupsWithFields();

        if ($getCustomFieldGroupsWithFields) {
            $this->fields = $getCustomFieldGroupsWithFields->fields;
        }
        $this->view = 'youtubes.ajax.create';

        if (request()->ajax()) {
            return $this->returnAjax($this->view);
        }

        return view('youtubes.create', $this->data);
    }
    public function index() 
    {

    }
    /**
     *
     * @param  StoreYoutubeRequest $request
     * @return void
     */
    public function store(StoreYoutubeRequest $request)
    {
        $this->addPermission = user()->permission('add_product');
        abort_403(!in_array($this->addPermission, ['all', 'added']));

        $youtube = new Youtube();
        $youtube->name = $request->name;
        $youtube->url = $request->price;
        $youtube->channel_code = $request->channel_code;
        $youtube->region = $request->region;
        $youtube->language = $request->language;
        $youtube->description = $request->description;
        $youtube->email_host_main = $request->email_host_main;
        $youtube->email_management = $request->email_management;
        $youtube->email_network = $request->email_network;
        $youtube->status = $request->status;
        $youtube->network = $request->network;
        $youtube->profit_sharing_percent = $request->profit_sharing_percent;
        $youtube->channel_manager = $request->channel_manager;
        $youtube->department_id = $request->department_id;
        $youtube->service_account = $request->service_account;
        $youtube->save();
        $redirectUrl = urldecode($request->redirect_url);

        if($request->add_more == 'true') {
            $html = $this->create();

            return Reply::successWithData(__('messages.recordSaved'), ['html' => $html, 'add_more' => true, 'youtubeID' => $youtube->id, 'defaultImage' => $request->default_image ?? 0]);
        }
        return Reply::successWithData(__('messages.recordSaved'), ['redirectUrl' => $redirectUrl, 'youtubeID' => $youtube->id, 'defaultImage' => $request->default_image ?? 0]);

    }
    public function view() 
    {
        
    }
    public function show() 
    {
        
    }
    public function destroy() 
    {

    }

    public function getAuthUrl(Request $request)
    {
        $serviceAccount = json_decode($request->service_account, true);
        $jsonContent = json_encode($request->service_account, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        $client = new Google_Client();
        $client->setAuthConfig($serviceAccount);
        $client->setRedirectUri('http://localhost/worksuite-new-5.4.8/public/account/youtubes/callback');
        $client->addScope([
            Google_Service_YouTube::YOUTUBE_READONLY, 
            Google_Service_YouTubeAnalytics::YT_ANALYTICS_READONLY,
            Google_Service_YouTubeAnalytics::YT_ANALYTICS_MONETARY_READONLY
        ]);
        $client->setAccessType('offline');
        $fileName = 'google/OAuth2-client.json';

        if (!Storage::exists('google')) {
            Storage::makeDirectory('google');
        }

        // Lưu tệp vào thư mục storage/app/google
        Storage::put($fileName, $jsonContent);
            return response()->json(['auth_url' => $client->createAuthUrl()]);
        }

    public function handleCallback(Request $request)
    {
        $client = new Google_Client();
        $client->setAuthConfig(public_path(Files::UPLOAD_FOLDER).'\google\OAuth2-client.json');
        $client->setRedirectUri('http://localhost/worksuite-new-5.4.8/public/account/youtubes/callback');
        $client->addScope([
            Google_Service_YouTube::YOUTUBE_READONLY, 
            Google_Service_YouTubeAnalytics::YT_ANALYTICS_READONLY,
            Google_Service_YouTubeAnalytics::YT_ANALYTICS_MONETARY_READONLY
        ]);
        $client->setAccessType('offline');
        $code = $request->get('code');
        $client->setHttpClient(new \GuzzleHttp\Client([
            'verify' => false, // Tắt kiểm tra SSL
        ]));
        $client->fetchAccessTokenWithAuthCode($code);
        $token = $client->getAccessToken();
        dd($token);
        return view('youtubes.callback', ['token' => json_encode($token)]);
    }

    public function checkServiceAccount(Request $request)
    {        
        $serviceAccount = json_decode($request->service_account, true);
        if($this->youtubeService->checkServiceAccount($serviceAccount)) {
            return response()->json(['status' => "success", 'message' => "Service account hợp lệ"]) ;
        }
        return response()->json(['status' => "error", 'message' => "Service account không hợp lệ"]) ;
    }
}
