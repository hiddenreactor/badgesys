<?php
    if (isset($_POST["user_id"])) {
     //    echo 'bbb';
     //    echo "\r\n";
     //    echo $_POST["user_id"];
     //    echo "\r\n";
        $M_ID = $_POST["user_id"];
     //    echo "M_ID is ";        
     //    echo $M_ID;
        $output = '';
        $connect = mysqli_connect("localhost", "root", "", "scout");
        //   $query = "SELECT * FROM members WHERE MemberID = '".$_POST["user_id"]."'";
      
     
        $query = "SELECT * FROM members WHERE members.MemberID = '".$_POST["user_id"]."' ORDER BY members.MemberName DESC";
        $result = mysqli_query($connect, $query);
        $row = mysqli_fetch_array($result);
        $output .= '
      <p>Badge Detail for <b>'.$row["MemberName"].'</b></p>
      <div class="table-responsive">  
           <table class="table table-bordered table-striped">
           <tr>  
                    <th>Section</th>
                    <th>Member Color</th>
                    <th>Badge Name</th>
                    <th>Badge Category</th>
                    <th>Badge Level</th>
                    <th>Date Tested</th>
                    <th>Tested By</th>
                </tr>            
           ';

        $query = "SELECT * FROM members, colors, sections, earned, badges, badgelevel, admin, category WHERE 
           earned.MemberID = members.MemberID   AND 
           earned.ColorID = colors.ColorID AND 
           earned.SectionID = sections.SectionID AND
           earned.BadgeID = badges.BadgeID AND
           earned.LevelID = badgelevel.LevelID AND 
           earned.AdminID = admin.AdminID AND 
           category.CategoryID = badges.CategoryID AND
           earned.MemberID = '".$_POST["user_id"]."' ORDER BY earned.BadgeEarnedID DESC
           ";


        $result = mysqli_query($connect, $query);
        //$row = mysqli_fetch_array($result);

        while ($row = mysqli_fetch_array($result)) {
            $output .= '  
          
                <tr>  
                     <td>'.$row["SectionName"].'</td>
                     <td>'.$row["Color"].'</td> 
                     <td>'.$row["BadgeName"].'</td> 
                     <td>'.$row["CategoryName"].'</td> 
                     <td>'.$row["Levels"].'</td> 
                     <td>'.$row["DateReceived"].'</td> 
                     <td>'.$row["FName"].'</td> 
                </tr>                
           ';
        }
        $output .= '           
           </table>  
      </div>  
      ';
        echo $output;

//         require_once('tcpdf/tcpdf.php');

//         // $M_ID = $_GET['success'];
//         // $con = mysqli_connect("localhost", "root", "", "scout");
//         // $query1 = "SELECT MemberName from members WHERE members.MemberID = $M_ID";
//         // $result = mysqli_query($con, $query1);
//         // $row = mysqli_fetch_assoc($result);

//         $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//         $obj_pdf->SetCreator(PDF_CREATOR);
//         $obj_pdf->SetTitle("Export Member Badge Details in PDF.");
//         $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
//         $obj_pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//         $obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
//         $obj_pdf->SetDefaultMonospacedFont('helvetica');
//         $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//         $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
//         $obj_pdf->setPrintHeader(false);
//         $obj_pdf->setPrintFooter(false);
//         $obj_pdf->SetAutoPageBreak(true, 10);
//         $obj_pdf->SetFont('helvetica', '', 12);
//         $obj_pdf->AddPage();
//         $content = '';
//         $content .= '<h1 align="center">Export Member Badge Details in PDF</h1>';
//         $content .= '  
//      <h3 align="center"> Badge earned by '.$row["MemberName"].'</h3><br />
//      <table border="1" cellspacing="0" cellpadding="5">   
//            <tr>  
//                <th width="15%">Section</th>  
//                <th width="20%">Badge</th>  
//                <th width="13%">Category</th>  
//                <th width="20%">Badge Level</th> 
//                <th width="15%">Date Tested</th> 
//                <th width="15%">Tested By</th> 
//            </tr>
//      ';
//         $content .= fetch_data();
//         $content .= '</table>';
//         $obj_pdf->writeHTML($content);
//         $obj_pdf->Output('badge_earned.pdf', 'I');
    
}
?>
