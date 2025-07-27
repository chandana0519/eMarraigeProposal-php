<?PHP

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\User; 
use App\Message; 
use App\Interest; 
use App\Flavourite;
use App\ProfileVisitor;

class Notification {
  public function getNotificationCount() {
		$mailCount = Message::where('touser_id', Auth::user()->id)
                ->where('is_read',0)            
                ->count();
        $interestCount = Interest::where('touser_id', Auth::user()->id)
                ->where('is_new',1)            
                ->count();
        $flavouritesCount = Flavourite::where('touser_id', Auth::user()->id)
                ->where('is_new',1)            
                ->count();
        $visitorCount = ProfileVisitor::where('touser_id', Auth::user()->id)
                ->where('is_new',1)            
                ->count();
        $notificationCount = 0;
        if ($interestCount>0) $notificationCount++;
        if ($flavouritesCount>0) $notificationCount++;
        if ($visitorCount>0) $notificationCount++;
        return [
                'updated' => $mailCount>0 || $interestCount>0 || $flavouritesCount>0 || $visitorCount>0 ? true:false,
                'mailCount' => $mailCount,
                'notificationCount' => $notificationCount,
                'interestCount' => $interestCount,
                'flavouritesCount' => $flavouritesCount,
                'visitorCount' => $visitorCount,
            ];
	}

	public function getLatestMessage(){
		return Message::with('fromUser')
				->where('touser_id', Auth::user()->id)
		 	   	->where('is_read', 0)
               	->orderBy('id', 'desc')
               	->get();
	}

	public function getLatestInterest(){
		return Interest::with('fromUser')
				->where('touser_id', Auth::user()->id)
		 	   	->where('is_new', 1)
               	->orderBy('id', 'desc')
               	->get();
	}
}