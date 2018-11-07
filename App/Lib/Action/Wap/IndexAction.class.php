<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function getBook(){

        header("Content-Type:text/html; charset=utf-8");
        $url="http://shuku.ymzww.cn/index.php/Interface/Shengwen/booklist";
        $book=json_decode(file_get_contents($url),true);
        if(is_array($book)){
            $book=$book['data'];
            foreach ($book as $k=>$v){
                $url1="http://shuku.ymzww.cn/index.php/Interface/Shengwen/books/bookid/".$v['bookid'];
                $info=json_decode(file_get_contents($url1),true);
                $info=$info['data'];
                // print_r($info);exit();
                if($info){
                    $result=M('Book')->where(['cpbook_id'=>$info['bookid']])->find();
                    if($result){
                        echo "第".$info['bookid'].'重复<br/>';
                    }else{
                        $data['cpbook_id']=$info['bookid'];
                        $data['cid']=2;
                        $data['uid']=1;
                        $data['model']=6;
                        $data['title']=$info['bookname'];
                        $data['create_time']=strtotime($info['update_time']);
                        $data['update_time']=strtotime($info['update_time']);
                        $data['status']=1;
                        $data['view']=9875;
                        $data['trash']=0;
                        $data['image']=0;
                        $data['tstype']=0;
                        $data['zuozhe']=$info['pen_name'];
                        $data['zishu']=$info['words'];
                        $data['zhishu']=100;
                        $data['desc']=$info['intro'];
                        $data['xstype']=$info['status']-1;
                        $data['tips']=0;
                        $data['score']=0;
                        $data['gzzj']=0;
                        $data['ishot']=0;
                        $data['free_stime']=0;
                        $data['free_etime']=0;
                        $data['isfree']=0;
                        $data['ismanhua']=0;
                        $data['zhuishu']=35;

                        M('Book')->add($data);

                    }
                }

            }

           }
        }

    public function getContent($id){
       $bookid= M('Book')->where(['cpbook_id'=>$id])->field('id')->find();
       $bookid=$bookid['id'];
        $url="http://shuku.ymzww.cn/index.php/Interface/Shengwen/showclist/bookid/".$id;
        $title = json_decode(file_get_contents($url),true);
        $title=$title['data']['volumes'][0]['chapters'];
        //print_r($title);exit();
        $content=M('Chapter');
        foreach($title as $k=>$v){
            $res=$content->where(['cid2'=>$v['chapter_id']])->find();
            if($res){
                echo "该章节重复";
            }else{
                $data=[
                    'cid' =>7,
                    'cid2' =>$v['chapter_id'],
                    'uid' =>1,
                    'model'   =>7,
                    'title' =>$v['chapter_name'],
                    'create_time'  =>strtotime($v['update_time']),
                    'update_time'  =>strtotime($v['update_time']),
                    'status'  =>1,
                    'view'  =>0,
                    'trash'    =>0,
                    'content'   =>'',
                    'isvip'  =>$v['is_vip'],
                    'bid'     =>$bookid,
                    'bid1'     =>$id,
                    'idx'    =>$v['chapter_order']
                ];
                $idss= $content->add($data);
                if($idss){
                    $url1="http://shuku.ymzww.cn/index.php/Interface/Shengwen/content/bookid/".$id."/chapterid/".$v['chapter_id'];
                    $des = json_decode(file_get_contents($url1),true);
                   // print_r($des);exit();
                    $des=$des['data'];
                    $aaaa['content']=$des['content'];
                   $content->where(['id'=>$idss])->save($aaaa);
                    echo "添加".$v['chapter_name']."成功<br/>";

                }

            }
        }
    }

}