<?php

// better place this on a separate file so you can reuse it
class xni_TableObject extends XoopsObject
{
    /**
     * constructor
     * @param        $row
     * @param string $id_name
     * @param string $pid_name
     * @param string $title_name
     */
    public function __construct($row, $id_name = 'cid', $pid_name = 'pid', $title_name = 'title')
    {
        parent::__construct();

        $this->initVar($id_name, XOBJ_DTYPE_INT, $row[$id_name]);
        $this->initVar($pid_name, XOBJ_DTYPE_INT, $row[$pid_name]);
        $this->initVar($title_name, XOBJ_DTYPE_TXTBOX, $row[$title_name]);
    }
}
