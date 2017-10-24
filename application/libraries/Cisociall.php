<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cisociall
{
	/* ------------ Count Total Discspace ------------ */
	public function disk_totalspace($dir)
    {
        return disk_total_space($dir);
    }

    /* ------------ Count Free Discspace ------------ */
    public function disk_freespace($dir)
    {
        return disk_free_space($dir);
    }

    /* ------------ Count Uses Discspace ------------ */
    public function disk_usespace($dir)
    {
        return $this->disk_totalspace($dir) - $this->disk_freespace($dir);
    }

    /* ------------ Count Free Discspace Percent ------------ */
    public function disk_freepercent($dir, $display_unit = FALSE)
    {
        if ($display_unit === FALSE)
        {
            $unit = NULL;
        }
        else
        {
            $unit = ' %';
        }
        return round(($this->disk_freespace($dir) * 100) / $this->disk_totalspace($dir), 0).$unit;
    }

    /* ------------ Count Uses Discspace Percent ------------ */
     public function disk_usepercent($dir, $display_unit = FALSE)
    {
        if ($display_unit === FALSE)
        {
            $unit = NULL;
        }
        else
        {
            $unit = ' %';
        }
        return round(($this->disk_usespace($dir) * 100) / $this->disk_totalspace($dir), 0).$unit;
    }

    /* ------------ Count Memory Usage ------------ */
    public function memory_usage()
    {
        return memory_get_usage();
    }

    /* ------------ Count Memory Peak Usage ------------ */
    public function memory_peak_usage($real = TRUE)
    {
        if ($real)
        {
            return memory_get_peak_usage(TRUE);
        }
        else
        {
            return memory_get_peak_usage(FALSE);
        }
    }

    /* ------------ Count Memory Usage Percent ------------ */
    public function memory_used_percent($real = TRUE, $display_unit = FALSE)
    {
        if ($display_unit === FALSE)
        {
            $unit = NULL;
        }
        else
        {
            $unit = ' %';
        }
        return round(($this->memory_usage() * 100) / $this->memory_peak_usage($real), 0).$unit;
    }
    /*--------------------------------------------------------------*/
} // Class End