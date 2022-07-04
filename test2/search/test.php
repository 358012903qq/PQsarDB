<?php
            require_once 'connect.php';
            //$id=$_GET['id'];
            //$name=$_GET['name'];

            //$sql="SELECT * FROM btdqsar where descriptor='$name'";
            $sql="SHOW TABLES";
            $result=$db->query($sql);
            //var_dump($result);

           $rows=[];

            while ($row=$result->fetch_assoc()) {
                $rows[]=$row;
            }

            //var_dump($rows);
            
            foreach ($rows as $row ) { 

                //var_dump($row) ;
                //$row['Tables_in_qsar'];
                $tablename = $row["Tables_in_qsar"];
                //echo $tablename;
                //echo "<br>";

                $sql="SELECT * FROM $tablename WHERE descriptor='z-scale' ";
                $result=$db->query($sql);

                //var_dump($result);

                if ($result==false) {
                    continue;
                }
                $rows=[];

                while ($row=$result->fetch_assoc()) 
                            {
                                $rows[]=$row;
                            }

               
                        foreach ($rows as $row ) { 
                        echo $row['Bioactive peptide'];
                    }
                                                

            }
        ?>