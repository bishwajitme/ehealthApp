<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sociall_model extends CI_Model
{
    /*--------------------------------------------------------------*/
    public function __construct()
    {
        parent::__construct();
        $this->primary_key      = 'userID';
        $this->ip_address       = 'ip_address';
        $this->table_name       = 'user';
        $this->table_sessions   = 'user_sessions';
        $this->provider_name    = 'provider_name';
        $this->identifier       = 'identifier';
    }

    /* ---------- Insert and Update User Profiles to [Social Users Table] ---------- */
    public function insert_update_social_users($data = array())
    {
        $this->db->select($this->primary_key);
        $this->db->from($this->table_name);
        $this->db->where(array($this->provider_name=>$data['provider_name'],$this->identifier=>$data['identifier']));
        $first_query = $this->db->get();
        $first_control = $first_query->num_rows();
        
        if($first_control > 0){
            $first_result = $first_query->row_array();
            $data['modified_date'] = time();
            $update = $this->db->update($this->table_name,$data,array($this->primary_key=>$first_result['userID']));
            $user_data_id = $first_result['userID'];
        }else{
            $data['created_date'] = time();
            $data['modified_date'] = time();
            $insert = $this->db->insert($this->table_name,$data);
            $user_data_id = $this->db->insert_id();
        }
            //if ($user_data_id) {return $user_data_id;} else {return FALSE;} // Normal if condition
            return $user_data_id?$user_data_id:FALSE; // Shortland version if condition
    }

    /* --- Delete Account from [Social Users Table] --- */
    public function delete_account($user_id, $user_identifier)
    {
        $this->db->where(array($this->primary_key=>$user_id, $this->identifier=>$user_identifier));
        $this->db->query("SET FOREIGN_KEY_CHECKS = 0");
        $query = $this->db->delete($this->table_name);
        $this->db->query("SET FOREIGN_KEY_CHECKS = 1");
        return $query;
    }

    /* --- Activate Account from [Social Users Table] --- */
    public function activate($id)
    {
        $data = array(
                'active' => 1
        );
        $this->db->where($this->primary_key, $id);
        $query = $this->db->update($this->table_name, $data);
        return $query;
    }

    /* --- Deactivate Account from [Social Users Table] --- */
    public function deactivate($id, $sess_identifier, $admin_identifier)
    {
        // Get datas from database
        $this->db->where(array($this->primary_key=>$id, $this->identifier=>$sess_identifier))->limit(1);
        // After control this data
        $query = $this->db->get($this->table_name)->row();
            // If it is admin account, there is no deactivation. Forbidden to deactivate admin account!

            if ($query->identifier==$admin_identifier) {
                // Do Nothing!
                $data = array(
                    'active' => 1
                );
                $this->db->where($this->primary_key, $id);
                $query = $this->db->update($this->table_name, $data);
                return $query;
            }
            else // If it is NOT admin account, deactivation completed
            {
                $data = array(
                    'active' => 0
                );
                $this->db->where($this->primary_key, $id);
                $query = $this->db->update($this->table_name, $data);
                return $query;
            }      
    }

    /* --- Delete Old Sessions from [user_Sessions Table] --- */
    public function delete_old_sessions()
    {
        $this->db->where(array('timestamp<'=>time()-600, $this->ip_address=>$this->input->ip_address()));
        $query = $this->db->delete($this->table_sessions);
        return $query;
    }
    /* --- Select All Social Users for Google Map in Admin Dashboard from [Social Users Table] --- */
    public function get_all_users()
    {
        $this->db->order_by('modified_date', "desc");
        $query = $this->db->get('user')->result();
        return $query;
    }
    /* --- Select All Social Users order by created time desc with limit for pagination from [Social Users Table] --- */
    public function get_all_users_orderby_modified_desc($per_page, $segment)
    {
        $this->db->limit($per_page, $segment);
        $this->db->order_by('modified_date', "desc");
        $query = $this->db->get($this->table_name)->result();
        return $query;
    }

    /* ---- Select Provider Users with limit for pagination from [Social Users Table] ---- */
    public function get_provider_users_for_pagination($per_page, $provider, $segment)
    {
        $this->db->limit($per_page, $segment);
        $this->db->where($this->provider_name, $provider);
        $this->db->order_by('modified_date', "desc"); 
        $query=$this->db->get($this->table_name)->result();
        return $query;
    }

    /* --- Already Login Profile Details [Social Users Table] --- */
    public function already_login($identifier)
    {
        $this->db->where($this->identifier, $identifier);
        $query = $this->db->get($this->table_name)->result();
        return $query;
    }

    /* --- Social User Profile Details [Social Users Table] --- */
    public function get_user_profile($user_id)
    {
        $this->db->where($this->primary_key, $user_id);
        $query = $this->db->get($this->table_name)->result();
        return $query;
    }

    /* --- Get Related Accounts which have same email with currents profile in [Social Users Table] --- */
    public function get_related_accounts($user_email, $user_id)
    {
        $this->db->where(array('email'=>$user_email, 'userID!='=>$user_id ));
        $this->db->order_by('modified_date', "desc"); 
        $query = $this->db->get($this->table_name)->result();
        return $query;
    }
    /* --- Get Role Id based on Registration [temporarily for assignment 2] --- */
    public function get_role_id($type, $roleName)
    {
        $this->db->where(array('type'=> $type,'name' => $roleName ));
        $query = $this->db->get('role')->result();
        return $query[0]->roleID;
    }
    /* --- Get Role Type --- */
    public function get_role_type($roleID)
    {
        $this->db->where(array('roleID'=> $roleID ));
        $query = $this->db->get('role')->result();
        return $query[0]->type;
    }
    /* --- Get Role Name --- */
    public function get_role_name($roleID)
    {
        $this->db->where(array('roleID'=> $roleID ));
        $query = $this->db->get('role')->result();
        if (count($query) > 0) {
            return $query[0]->name;
        }
        else
        {
            return false;
        }

    }

    /* --- Get Role Name --- */
    public function get_user_name($userID)
    {
        $this->db->where(array('userID'=> $userID ));
        $query = $this->db->get('user')->result();
        if (count($query) > 0) {

            return $query[0]->name;
        }
        else
        {
            return false;
        }
    }

    /* --- Get Connected patient details for Physician and Researcher --- */
    public function get_patient_detail($userID)
    {
        $this->db->select('user.*');
        $this->db->from('user');
        $this->db->join('therapy', 'therapy.User_IDpatient = user.userID', 'left');
        $this->db->where(array('therapy.User_IDmed'=> $userID ));
        $query = $this->db->get();
        return $query->result();

    }

    /* --- Get Connected patient theraphy for Physician and Researcher --- */
    public function get_patient_theraphy($phyID, $userID)
    {
        $this->db->select('therapy_list.*, therapy.therapyID');
        $this->db->from('therapy_list');
        $this->db->join('therapy', 'therapy.TherapyList_IDtherapylist = therapy_list.therapy_listID', 'INNER JOIN');
        $this->db->where(array('therapy.User_IDpatient'=> $userID, 'therapy.User_IDmed'=> $phyID ));
        $query = $this->db->get();
        if($query->num_rows() != 0)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }

    /* --- Get Connected patient theraphy for Patient --- */
    public function retrive_patient_theraphy($userID)
    {
        $this->db->select('therapy_list.*, therapy.therapyID');
        $this->db->from('therapy_list');
        $this->db->join('therapy', 'therapy.TherapyList_IDtherapylist = therapy_list.therapy_listID', 'INNER JOIN');
        $this->db->where(array('therapy.User_IDpatient'=> $userID));
        $query = $this->db->get();
        if($query->num_rows() != 0)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }


    /* --- Get Connected patient test data for Physician and Researcher --- */
    public function get_patient_test_data($therapyID, $phyID, $userID)
    {
        $this->db->select('test.dateTime, test_session.*');
        $this->db->from('test');
        $this->db->join('therapy', 'therapy.therapyID = test.Therapy_IDtherapy', 'left');
        $this->db->join('test_session', 'test.testID=test_session.Test_IDtest', 'left');
        $this->db->where(array('therapy.User_IDpatient'=> $userID, 'therapy.User_IDmed'=> $phyID, 'therapy.therapyID' => $therapyID));
        $query = $this->db->get();
        if($query->num_rows() != 0)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }

    /* --- Get  patient session data for Researcher --- */
    public function get_patient_data_researcher()
    {
        $this->db->select('test.dateTime, test_session.*, note.note, therapy.User_IDpatient, note.User_IDmed');
        $this->db->from('test');
        $this->db->join('test_session', 'test.testID=test_session.Test_IDtest', 'left');
        $this->db->join('note', 'test_session.test_SessionID = note.Test_Session_IDtest_session', 'left');
        $this->db->join('therapy', 'therapy.therapyID = test.Therapy_IDtherapy', 'left');
        $query = $this->db->get();
        if($query->num_rows() != 0)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }

    /* --- Get test Note --- */
    public function get_test_note($test_SessionID, $phyID)
    {
        $this->db->where(array('Test_Session_IDtest_session'=> $test_SessionID, 'User_IDmed'=> $phyID));
        $query = $this->db->get('note')->result();
        return $query;

    }

    /* --- Get test Note vy session only --- */
    public function get_test_note_by_sessionId($test_SessionID)
    {
        $this->db->where(array('Test_Session_IDtest_session'=> $test_SessionID));
        $query = $this->db->get('note')->result();
        return $query;

    }

    /* --- Get test Note by Id --- */
    public function get_test_note_by_ID($noteID)
    {
        $this->db->where(array('noteID'=> $noteID));
        $query = $this->db->get('note')->result();
        return $query;

    }
    /* --- Get Medicine Name --- */
    public function get_medicine_name($medID)
    {
        $this->db->where(array('medicineID'=> $medID));
        $query = $this->db->get('medicine')->result();
        return $query[0]->name;
    }

    public function submit_annotation()
    {
        //  $this->form_validation->set_rules('annotation', 'annotation', 'required');
        $noteId = $this->input->post('noteid');
        $field = array(
            'noteId'=>$this->input->post('noteid'),
            'Test_Session_IDtest_session'=>$this->input->post('sessionId'),
            'note'=>$this->input->post('annotation'),
            'User_IDmed'=>$this->input->post('user_IDmed')
        );
        if($noteId!=""){
            $this->db->where(array('noteID'=> $noteId ));
            $this->db->update('note', $field);
        }
        else{
            $this->db->insert('note', $field);
        }

        if($this->db->affected_rows()>0){
            return true;
        }
        else{
            return false;
        }

    }


    /*--------------------------------------------------------------*/
} // Class End