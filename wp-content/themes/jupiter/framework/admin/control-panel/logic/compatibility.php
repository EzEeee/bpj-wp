<?php
/**
 * This class is responsible for checking all stats and jupiter needs such as
 * directory permission and notify user about warnings and errors
 *
 *
 * @author       Reza Marandi <reza@marandi.ir>
 * @copyright    Artbees LTD (c)
 * @link         http://artbees.net
 * @since        5.4
 * @version      1.0
 * @package      jupiter
 */
class Compatibility
{
    private $template_dir;
    private $schedule;

    public function setSchedule($schedule)
    {
        $this->schedule = $schedule;
    }
    public function getSchedule()
    {
        return $this->schedule;
    }

    public function setTemplateDir($template_dir)
    {
        $this->template_dir = $template_dir;
    }
    public function getTemplateDir()
    {
        return $this->template_dir;
    }
    private $assets_dir;
    public function setAssetsDir($assets_dir)
    {
        $this->assets_dir = $assets_dir;
    }
    public function getAssetsDir()
    {
        return $this->assets_dir;
    }
    public function __construct()
    {
    }
    public function setMkTemplatesDirectory()
    {
        $upload_path = wp_upload_dir();
        $this->setTemplateDir($upload_path['basedir'] . "/mk_templates/");
    }
    public function compatibilityCheck()
    {
        // Set upload path
        $upload_path = wp_upload_dir();
        $this->setTemplateDir($upload_path['basedir'] . "/mk_templates/");
        $this->setAssetsDir($upload_path['basedir'] . "/mk_assets/");

        // Check folder permission and create them if not exist
        //
        $response = [];
        // If response is a multidimentional array ,
        // we should merge it to general response ,
        // general response is always 2 level array not more.
        $php_ini_response = $this->phpIniCheck();
        $response         = array_merge($php_ini_response, $response);
        $response[]       = $this->checkAndCreate($this->getTemplateDir());
        $response[]       = $this->checkAndCreate($this->getAssetsDir());

        // if schedule is setted or not
        if ($this->getSchedule() == 'off')
        {
            return $this->prepareMessage($response);
        }
        else
        {
            if (($value = get_transient('compatibility_check')) === false)
            {
                set_transient('compatibility_check', true, $this->getSchedule());
                return $this->prepareMessage($response);
            }
            else
            {
                return;
            }
        }

    }
    /**
     * This method will verify if directory is wirtable or not.
     *
     * @param string $path Set directory path that need to be check
     *
     * @author Reza Marandi <reza@marandi.ir>
     *
     * @return bool
     */
    public function isWritable($path)
    {
        return is_writable($path);
    }
    /**
     * This method will create directory if dir path is not exist and return errors.
     *
     * @param string $path Set directory path that need to be check
     *
     * @author Reza Marandi <reza@marandi.ir>
     *
     * @return array array of messages
     */
    public function checkAndCreate($path)
    {
        if (file_exists($path) == true)
        {
            if ($this->isWritable($path) == false)
            {
                return [
                    'sys_msg'       => $path . ' directory is not writable, ',
                    'sys_recommend' => 'Set read/write (0775) permission for this directory .',
                    'link_href'     => '',
                    'link_title'    => '',
                    'type'          => 'error',
                    'status'        => false,
                ];
            }
            else
            {
                return [
                    'status' => true,
                ];
            }
        }
        else
        {
            if (@mkdir($path, 0775, true) == false)
            {
                return [
                    'sys_msg'       => 'Jupiter can\'t create ' . $path . ' directory. ',
                    'sys_recommend' => 'Please check permission on this directory.',
                    'link_href'     => '',
                    'link_title'    => '',
                    'type'          => 'error',
                    'status'        => false,
                ];
            }
            else
            {
                return [
                    'status' => true,
                ];
            }

        }
    }
    /**
     * This method will verify all php.ini variables and requirement that wordpress need.
     *
     *
     * @author Bob Ulusoy , Reza Marandi <reza@marandi.ir>
     *
     * @return array array of messages
     */
    public function phpIniCheck()
    {
        $max_execution_time            = ini_get("max_execution_time");
        $max_input_time                = ini_get("max_input_time");
        $upload_max_filesize           = ini_get("upload_max_filesize");
        $incorrect_max_execution_time  = ($max_execution_time < 60 && $max_execution_time > 0);
        $incorrect_max_input_time      = ($max_input_time < 60 && $max_input_time > 0);
        $incorrect_memory_limit        = ($this->let_to_num(WP_MEMORY_LIMIT) < 100663296);
        $incorrect_upload_max_filesize = ($this->let_to_num($upload_max_filesize) < 10485760);
        $response                      = [];
        if ($incorrect_max_execution_time || $incorrect_max_input_time || $incorrect_memory_limit || $incorrect_upload_max_filesize)
        {
            $response = [];
            if ($incorrect_max_execution_time)
            {
                $response[] = [
                    'sys_msg'       => 'Maximum Execution Time: ' . $max_execution_time . ' seconds, ',
                    'sys_recommend' => 'max_execution_time should be at least 60 seconds.',
                    'link_href'     => '',
                    'link_title'    => '',
                    'type'          => 'error',
                    'status'        => false,
                ];
            }
            if ($incorrect_max_input_time)
            {
                $response[] = [
                    'sys_msg'       => 'Maximum Input Time: ' . $max_input_time . ' seconds, ',
                    'sys_recommend' => 'max_input_time should be at least 60 seconds.',
                    'link_href'     => '',
                    'link_title'    => '',
                    'type'          => 'error',
                    'status'        => false,
                ];
            }
            if ($incorrect_memory_limit)
            {
                $response[] = [
                    'sys_msg'       => 'Wordpress Memory Limit: ' . WP_MEMORY_LIMIT . ', ',
                    'sys_recommend' => 'memory_limit should be at least 96MB.',
                    'link_href'     => 'http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP',
                    'link_title'    => 'Increasing memory allocated to PHP',
                    'type'          => 'error',
                    'status'        => false,
                ];
            }
            if ($incorrect_upload_max_filesize)
            {
                $response[] = [
                    'sys_msg'       => 'Maximum Upload File Size : ' . $upload_max_filesize . ', ',
                    'sys_recommend' => 'upload_max_filesize should be at least 10MB.',
                    'link_href'     => '',
                    'link_title'    => '',
                    'type'          => 'error',
                    'status'        => false,
                ];
            }
            return $response;
        }
        else
        {
            return [];
        }

    }
    /**
     * This method will prepare class reponses to wordpress admin notification structure.
     *
     * @param array $messages set of messages data
     *
     * @author Reza Marandi <reza@marandi.ir>
     *
     * @return string
     */
    public function prepareMessage($messages)
    {
        if (empty($messages) == false && is_array($messages))
        {
            $warning_message = $error_message = $response = '';
            foreach ($messages as $key => $value)
            {
               if(isset($value['type'])) {
                    switch ($value['type'])
                    {
                        case 'error':
                            $error_message .= '<li style="margin-bottom:10px;"><strong>' . $value['sys_msg'] . '</strong>' . $value['sys_recommend'] . '&nbsp;&nbsp;&nbsp;<a href="' . $value['link_href'] . '">' . $value['link_title'] . '</a></li>';
                            break;
                        case 'warning':
                            $warning_message .= '<li style="margin-bottom:10px;"><strong>' . $value['sys_msg'] . '</strong>' . $value['sys_recommend'] . '&nbsp;&nbsp;&nbsp;<a href="' . $value['link_href'] . '">' . $value['link_title'] . '</a></li>';
                            break;
                    }
                }
            }
            if (empty($error_message) == false)
            {
                $response .= '<div class="notice notice-error is-dismissible" style="font-size:14px !important;"><br><strong>'.__('Please resolve these issues for maximum compatibility!', 'mk_framework').'</strong>
    <ol>' . $error_message . '</ol><button type="button" class="notice-dismiss"><span class="screen-reader-text">'.__('Dismiss this notice.', 'mk_framework').'</span></button></div>';
            }
            if (empty($warning_message) == false)
            {
                $response .= '<div class="notice notice-warning is-dismissible" style="font-size:14px !important;"><br><strong>'.__('Please read this warnings carefully', 'mk_framework').'</strong>
    <ol>' . $error_message . '</ol><button type="button" class="notice-dismiss"><span class="screen-reader-text">'.__('Dismiss this notice.', 'mk_framework').'</span></button></div>';
            }

            return $response;
        }
        else
        {
            return;
        }
    }
    private function let_to_num($size)
    {
        $l   = substr($size, -1);
        $ret = substr($size, 0, -1);

        switch (strtoupper($l))
        {
            case 'P':
                $ret *= 1024;
            case 'T':
                $ret *= 1024;
            case 'G':
                $ret *= 1024;
            case 'M':
                $ret *= 1024;
            case 'K':
                $ret *= 1024;
        }

        return $ret;
    }
}
