
<?php

function pagination($item)
{

    $route = url()->current();

    if ($item->lastPage() == 1) {
        return '';
    }
    $lastPage = $item->lastPage();
    $currentPage = $item->currentPage();
    // $nextPage = $route.'?page='.$currentPage+1;
    // $previousPage = $route.'?page='.$currentPage-1;
    $nextPage = $item->nextPageUrl();
    $previousPage = $item->previousPageUrl();

    // dd($lastPage, $currentPage, $nextPage, $previousPage);

    $html = '<div class="paginating-container pagination-solid ">
    <ul class="pagination">';

    if ($currentPage == 1) {

        $html .= '<li  class="prev">
        <a href="javascript:void(0);">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left">
        <polyline points="15 18 9 12 15 6"></polyline>
        </svg>
        </a>';
    } else {
        $html .= '<li  class="prev">
        <a href="' . $previousPage . '">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left">
        <polyline points="15 18 9 12 15 6"></polyline>
        </svg>
        </a>';
    }

    for ($i = 1; $i <= $lastPage; $i++) {


        if ($lastPage <= 10) {
            if ($i == $currentPage) {
                $html .= '<li class="active"><a href="javascript:void(0);">' . $i . '</a></li>';
            } else {
                $html .= '<li><a href="' . $item->url($i) . '">' . $i . '</a></li>';
            }
            continue;
        }
        $show = round($lastPage / 2);
        // if($i == 1 || $i == $lastPage || $i == $currentPage || $i == $currentPage-1 || $i == $currentPage+1 || $i == $currentPage-2 || $i == $currentPage+2  || $i == $show-1 || $i == $show+1 || $i == $show)
        if ($i == 1 || $i == $lastPage || $i == $currentPage || $i == $currentPage - 1 || $i == $currentPage + 1  || $i == $show - 1 || $i == $show + 1 || $i == $show) {
            if ($i == $currentPage) {
                $html .= '<li class="active"><a href="javascript:void(0);">' . $i . '</a></li>';
            } else {
                $html .= '<li><a href="' . $item->url($i) . '">' . $i . '</a></li>';
            }
        } else {

            if ($i == $currentPage - 2 || $i == $currentPage + 2) {
                $html .= '<li><a href="javascript:void(0);">...</a></li>';
            }
        }
    }

    // if page is more than 10 then current page is greater than 5 then show first page and show middle page as dot dot dot

    if ($currentPage == $lastPage) {
        $html .= '<li class="next">
        <a href="javascript:void(0);">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
        <polyline points="9 18 15 12 9 6"></polyline>
        </svg>
        </a>
        </li>';
    } else {
        $html .= '<li class="next">
        <a href="' . $nextPage . '">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
        <polyline points="9 18 15 12 9 6"></polyline>
        </svg>
        </a>
        </li>';
    }

    $html .= '</ul>
    </div>';



    return $html;


    // for ($i=0; $i < ; $i++) {
    //     # code...
    // }

    //     return '<div class="paginating-container pagination-solid">
    //     <ul class="pagination">
    //         <li  class="prev"><a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg></a></li>
    //         <li><a href="javascript:void(0);">1</a></li>
    //         <li class="active"><a href="javascript:void(0);">2</a></li>
    //         <li><a href="javascript:void(0);">3</a></li>
    //         <li class="next"><a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></a></li>
    //     </ul>
    // </div>';
}


// fileupload
function fileupload($file,$path,$type = 'short'){
   $file=$file->store($path);
   $file = str_replace('public/', '', $file);
    if($type == 'full')
    {
        return url('/').'/storage/'.$file;
    }

   return 'storage/'.$file;
}
