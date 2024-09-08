<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Models\ConsultationSettingModel;
use App\Models\ConsultationModel;
use App\Models\FamilyMemberModel;

use Validator;
use Sentinel;
use Session;
use Artisan;
use Storage;
use Flash;

class BackupController extends Controller
{
    public function __construct()
    {
        $this->arr_view_data            = [];
        $this->module_url_path          = url(config('app.project.admin_panel_slug')."/backup");
        $this->module_title             = "Backup";
        $this->module_view_folder       = "admin.backup";
        $this->admin_panel_slug         = config('app.project.admin_panel_slug');

        $this->ConsultationSettingModel = new ConsultationSettingModel();
        $this->ConsultationModel        = new ConsultationModel();
        $this->FamilyMemberModel        = new FamilyMemberModel();
    }


    public function index()
    {
        $backups = $arr_backup = [];

        $this->arr_view_data['page_title'] = str_singular($this->module_title);

        $user = Sentinel::check();
        if($user):

            if($user->inRole('admin')):

                $disk  = Storage::disk(config('storage.app'));        
                $files = $disk->files(config('laravel-backup.backup.name'));
                
                // make an array of backup files, with their filesize and creation date
                if (isset($files) && sizeof($files)>1) 
                {
                    foreach ($files as $k => $f) 
                    {
                        //only take the zip files into account
                        if(substr($f, -4) == '.zip' && $disk->exists($f)) 
                        {
                            $mb_size = number_format( $disk->size($f) * 0.00000095367432 );

                            $backups[] = [
                                'file_path'     => $f,
                                'file_name'     => str_replace(config('laravel-backup.backup.name') . '/', '', $f),
                                'file_size'     => $mb_size.' mb ( '.$disk->size($f).' bytes)',
                                'last_modified' => date("h:i A d-M-Y",$disk->lastModified($f)),
                            ];
                        }
                    }

                    $arr_backup = array_reverse($backups);
                }
                //dd( $arr_backup );

                $this->arr_view_data['arr_backup']      = $arr_backup;
                $this->arr_view_data['module_url_path'] = $this->module_url_path;
                $this->arr_view_data['module_title']    = str_singular($this->module_title);

                return view($this->module_view_folder.'.index',$this->arr_view_data);

            else:
                Flash::error('You don\'t have sufficient privileges.');
                redirect($this->admin_panel_slug.'/login');
            endif;
        else:
            Flash::error('Please login to your account.');
            redirect($this->admin_panel_slug.'/login');
        endif;
    } // end index

    public function database()
    {
        Artisan::call('backup:run',['--only-db'=>true]);
        Artisan::output();
        
        Flash::success('Database Backup Created Successfully');
        return redirect()->back();
    }

    public function files()
    {
        Artisan::call('backup:run',['--only-files'=>true]);
        Artisan::output();
        
        Flash::success('Files Backup Created Successfully');
        return redirect()->back();
    }

    public function backup_all()
    {
        Artisan::call('backup:run');
        //Artisan::output();
        
        Flash::success('Files and Database Backup Created Successfully');
        return redirect()->back();
    }

    public function download($file_name)
    {
        $file_path  = '/opt/lampp/htdocs/mobi_doctor/storage/app/';
        $pathToFile = $file_path.$file_name;
        $file_exits = file_exists($pathToFile);
        
        if($file_exits):
            return response()->download($pathToFile); 
        else:
            Flash::error('Something went wrong while Backup Downloading');
            return redirect()->back();
        endif;
    }

    public function delete($file_name)
    {
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);
        
        if($disk->exists(config('laravel-backup.backup.name') . '/' . $file_name)):
            $disk->delete(config('laravel-backup.backup.name') . '/' . $file_name);   
            Flash::success('Backup Deleted Successfully');
            return redirect()->back();
        else:
            Flash::error('Something went wrong while Backup Deleting');
            return redirect()->back();
        endif;
    }

}   
