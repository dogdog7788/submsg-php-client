<?PHP
    require 'message.php';
    class MESSAGEXsend{
        
        protected $appid='';
        
        protected $appkey='';
        
        protected $sign_type='';
        
        protected $To=array();
        
        protected $Addressbook=array();
        
        protected $tempid='';
		
		protected $region_code='';
        
        protected $Vars=array();
        
        function __construct($configs){
            $this->appid=$configs['appid'];
            $this->appkey=$configs['appkey'];
            if(!empty($configs['sign_type'])){
                $this->sign_type=$configs['sign_type'];
            }
        }
        
        public function SetTo($address){
            $this->To=trim($address);
        }
        
        public function AddAddressbook($addressbook){
            array_push($this->Addressbook,$addressbook);
        }
        
        public function SetTempid($tempid){
            $this->tempid=$tempid;
        }
		
        public function SetRegionCode($region_code){
			 $this->region_code=$region_code;
		}
        public function AddVar($key,$val){
            $this->Vars[$key]=$val;
        }

        
        public function buildRequest(){
            $request=array();
             $request['to']=$this->To;
            $request['tempid']=$this->tempid;
			$request['region_code']=$this->region_code;
            if(!empty($this->Vars)){
                $request['vars']=json_encode($this->Vars);
            }
            return $request;
        }
        public function xsend(){
            $message_configs['appid']=$this->appid;
            $message_configs['appkey']=$this->appkey;
            if($this->sign_type!=''){
                $message_configs['sign_type']=$this->sign_type;
            }
            $message=new message($message_configs);
            return $message->xsend($this->buildRequest());
        }
		
		public function xsendInternational(){
            $message_configs['appid']=$this->appid;
            $message_configs['appkey']=$this->appkey;
            if($this->sign_type!=''){
                $message_configs['sign_type']=$this->sign_type;
            }
            $message=new message($message_configs);
            return $message->xsendInternational($this->buildRequest());
        }
        
    }