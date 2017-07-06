<?php
require_once 'libdb.php';
DB::init("guesthouse");

class page
{
    protected $id;
    protected $title;
    protected $menu;
    
    function __construct($id,$title,$menu) 
    {
        $this->id=$id;
        $this->title=$title;
        $this->menu=$menu;
    }
    
    function getId()
    {
        return $this->id;
    }
    
    function setId($id)
    {
        $this->id=$id;
    }
    
    function getTitle()
    {
        return $this->title;
    }
    
    function setTitle($title)
    {
        $this->title=$title;
    }
    
    function getMenu()
    {
        return $this->menu;
    }
    
    function setMenu($menu)
    {
        $this->menu=$menu;
    }
    
    function getContent()
    {
        // no id in database 
        if($this->id == '') 
        {
            return "";
        }
        // return array of rows
        $rows=DB::doSql("SELECT content FROM page WHERE id=".DB::toSql($this->id));
        return $rows[0]['content'];
        
    }
    
    function setContent($content)
    {
        DB::doSql("UPDATE page SET content=".DB::toSql($content)."WHERE id=".DB::toSql($this->id));
    }
    
    function save($oldId)
    {
        if($oldId) // if had id, page was in table, use UPDATE
        {
            $sql=sprintf(
                    "UPDATE page SET id=%s, title=%s, menu=%s WHERE id=%s",
                    DB::toSql($this->getId()),
                    DB::toSql($this->getTitle()),
                    DB::toSql($this->getMenu()),
                    DB::toSql($oldId)
                    );
            DB::doSql($sql);
            }else{ 
                // if row didn't exist, use INSERT
                $sql=sprintf(
                    "INSERT INTO page SET id=%s, title=%s, menu=%s",
                    DB::toSql($this->getId()),
                    DB::toSql($this->getTitle()),
                    DB::tosql($this->getMenu())
                    );
            DB::doSql($sql);
        }
    }
    
    // delete page from database
    function delete() 
    {
        DB::doSql("DELETE FROM page WHERE id=".DB::toSql($this->id));
    }
    
    // save order of titles
    static function saveOrder($order)
    {
        $i=0;
        // get array of ids, ordered by page_order
        foreach($order as $pageId)
        {
            DB::doSql("UPDATE page SET page_order=".DB::toSql($i)." WHERE id=".DB::toSql($pageId));
            $i++;
        }
    }
}
 
// get list of pages from database, ordered by page_order
$pages=DB::doSql("SELECT * FROM page ORDER BY page_order");
$listOfPages=array();
foreach($pages as $instance)
{
    $listOfPages[$instance['id']]=new page($instance['id'],$instance['title'],$instance['menu']);
}