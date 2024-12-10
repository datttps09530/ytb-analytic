<?php
namespace App\Services;

use App\Models\Youtube;
use Google_Client;
use Google_Service_YouTube;
use Google_Service_YouTubeAnalytics;

class YouTubeService
{
    protected $client;

    public function __construct()
    {
    }
    public function setClient($serviceAccount)
    {
        $access_token = '{"access_token": "ya29.a0AeDClZBf4Vh5rZJkKOtBABAzzCTWLSs_7o84HzOrqCRIEygn35oaoiwoK_LvEcIksiGlLsbqWMj9UBvnfJ3Z_oJjH1ZJDpukCmMLbY6ZbYNlNkBiLjMmAryO9P2lNRYFeFcHpy6D9zBrd1aXyyTztY9NnW90n-PXOlQaCgYKAfgSARASFQHGX2MiqqXQIZjfmEv6JKxelXnKrg0170"}';
        $refresh_token = '1//0ewTF_9Juc17wCgYIARAAGA4SNwF-L9IrvyxGCMUeT7js9wmKwGHn6gvDCtRs31Mmu3lCWYTS_Ja8kq6KDIq0cBymKnY8gxLvbNE';
        $this->client = new Google_Client();
        $this->client->setApplicationName('demo Youtube API');
        $this->client->addScope([
            Google_Service_YouTube::YOUTUBE_READONLY, 
            Google_Service_YouTubeAnalytics::YT_ANALYTICS_READONLY,
            Google_Service_YouTubeAnalytics::YT_ANALYTICS_MONETARY_READONLY
        ]);
        $this->client->setClientId('52158434027-hmoav82ia295fvqtj1c5ljf18ft6ks70.apps.googleusercontent.com');
        $this->client->setClientSecret('52158434027-hmoav82ia295fvqtj1c5ljf18ft6ks70.apps.googleusercontent.com');
        $this->client->setRedirectUri('http://localhost/worksuite-new-5.4.8/public/account');
        $this->client->setAccessType('offline');
        $this->client->setHttpClient(new \GuzzleHttp\Client([
            'verify' => false, // Tắt kiểm tra SSL
        ]));
        if ($access_token != '') {
            $accessToken = json_decode($access_token, true);
            $this->client->setAccessToken($accessToken);
        } else {
        }

        if ($this->client->isAccessTokenExpired()) {
            if ($this->client->getRefreshToken()) {
                $this->client->fetchAccessTokenWithRefreshToken($refresh_token);
            } else {
            }
        }
        
        
    }
    public function checkServiceAccount($serviceAccount) 
    {
        $this->setClient($serviceAccount);
        try {
            $youtube = new Google_Service_YouTube($this->client);

            $channels = $youtube->channels->listChannels('snippet,contentDetails', [
                'id' => 'UCEnFo2BnbKT4ITrpKOkGJUw',  // Lấy thông tin kênh của chính bạn
            ]);
            $youtubeAnalytics = new Google_Service_YouTubeAnalytics($this->client);
            $channel = $channels->getItems()[0];
            $report = $youtubeAnalytics->reports->query([
                'ids' => 'channel==UCOoltK24qRsl5px5Gw0z0OQ', // Thay bằng channel ID
                'startDate' => '2024-01-01',
                'endDate' => '2024-01-28',
                'metrics' => 'views,estimatedRevenue',
            ]);
            dd($report->getRows());
            if($channel) {
                return true;
            }
            return false;
        } catch (\Google_Service_Exception $e) {
            report($e->getMessage());
            return false;
        } catch (\Exception $e) {
            report($e->getMessage());
            return false;
        }
    }
    public function getListVideosByYoutube(Youtube $youtube) 
    {
        $this->setClient($youtube->service_account);
        $channels = $youtube->channels->listChannels('snippet,contentDetails', [
            'id' => $youtube->channel_code,  // Lấy thông tin kênh của chính bạn
        ]);
        if (count($channels->getItems()) > 0) {
            // Lấy ID của kênh
            $channelId = $channels->getItems()[0]->getId();
    
            echo "Channel ID: $channelId\n";
    
            // Lấy playlist của kênh (playlist chứa tất cả video của kênh)
            $playlistId = $channels->getItems()[0]->getContentDetails()->getRelatedPlaylists()->getUploads();
            dd($playlistId);
            // Lấy tất cả video từ playlist "uploads"
            $playlistItems = $youtube->playlistItems->listPlaylistItems('snippet', [
                'playlistId' => $playlistId,
                'maxResults' => 50,  // Số video mỗi lần lấy, có thể điều chỉnh
            ]);
    
            // Duyệt qua tất cả video và hiển thị thông tin
            return $playlistItems->getItems();
        } else {
            return false;
        }
        
    }

    public function getProfitVideoByYoutube(Youtube $youtube, $from_date, $to_date)
    {
        $this->setClient($youtube->service_account);
        try {
            $youtubeAnalytics = new Google_Service_YouTubeAnalytics($this->client);
            // Thực hiện truy vấn báo cáo doanh thu
            $report = $youtubeAnalytics->reports->query(
                'channel==' . $youtube->channel_code,
                $from_date,  // Ngày bắt đầu báo cáo (theo định dạng YYYY-MM-DD)
                $to_date,  // Ngày kết thúc báo cáo (theo định dạng YYYY-MM-DD)
                'revenue',      // Chỉ báo cáo về doanh thu
                [
                    'metrics' => 'views,estimatedRevenue',
                    'dimensions' => 'video',
                ]
            );
            return $report->getRows();
        } catch (\Google_Service_Exception $e) {
            report($e->getMessage());
            return false;
        } catch (\Exception $e) {
            report($e->getMessage());
            return false;
        }
    }
}
