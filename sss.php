                <?php

                    $sql = "SELECT * FROM info";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo'
                        <div class="col-md-4" style="padding: 10px;">
                        <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><ion-icon name="mail"></ion-icon> '.$row['Gmail'].'</div>
                        </div>
                        <div class="col-md-4" style="padding: 10px;">
                        <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><ion-icon name="logo-facebook"></ion-icon> <a href="'.$row['FB'].'" target="_blank">'.$row["FB"].'</a></div>
                        </div>
                        <div class="col-md-4" style="padding: 10px;">
                        <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><ion-icon name="call"></ion-icon> '.$row['ContNum'].'</div>
                        </div>
                        ';
                    }else{
                        echo '
                        <div class="col-md-4" style="padding: 10px;">
                        <div><ion-icon name="mail"></ion-icon> rentit@gmail.com</div>
                        </div>
                        <div class="col-md-4" style="padding: 10px;">
                        <div><ion-icon name="logo-facebook"></ion-icon> Rent IT</div>
                        </div>
                        <div class="col-md-4" style="padding: 10px;">
                        <div><ion-icon name="call"></ion-icon> +63 992 2762 412</div>
                        </div>
                        ';
                    }
                    

                ?>

                        <?php

                            $sql = "SELECT * FROM info";
                            $result = $conn->query($sql);
                            $result->num_rows;
                            $row = $result->fetch_assoc();
                            $aboutText = $row['About'] ?? '';
                            if (!empty($aboutText)) {
                                echo "
                                <div class='col-md-8 us'>
                              
                                <p id='about-link'>".nl2br(htmlspecialchars($aboutText))."</p>
                                </div>
                                ";
                            }else{
                                echo "
                                <div class='col-md-8 us'>
                                <h2><button type='button' id='edit-save-button' class='btn btn-primary' onclick='toggleEditSave()'>Edit</button>
                                <button type='submit' id='save-button' class='btn btn-success' style='display:none;'>Save</button></h2><br>
                                <div id='aboutt-link'>
                                    <p>Welcome to Rent IT, your trusted partner for seamless dorm and apartment bookings. We specialize in connecting boarders with comfortable and affordable accommodations tailored to their needs. Whether you're a student looking for a convenient dormitory or a professional seeking a cozy apartment, our platform offers a diverse range of options to suit every lifestyle and budget.</p><br>
                                    <p>Our mission is to simplify the booking process, providing a user-friendly platform where you can easily find, book, and manage your stay. With a focus on quality, security, and customer satisfaction, we ensure that every property listed meets our high standards. Our dedicated support team is always here to assist you, making your experience as smooth and enjoyable as possible.</p><br>
                                    <p>At Rent IT, we're not just about finding you a place to stay; we're about helping you find your home away from home.</p>
                                </div>
                                
                                </div>
                                ";
                            }
                        
                        ?>

                        <?php

                        $sql = "SELECT * FROM info";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo'
                            <div class="col-md-4">
                            <div class="cont">
                            <ion-icon name="logo-facebook" class="fb"></ion-icon><br>
                            <h3 class="top">Rent IT</h3>
                            <p id="fb-link" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><a href="'.$row['FB'].'" target="_blank">'.$row["FB"].'</a></p>
                            <p id="fbb" style="display:none;"><input name="fb" class="inp" type="text" value="'.$row["FB"].'" disabled></p>
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="cont">
                            <ion-icon name="call" class="call"></ion-icon><br>
                            <h5 class="top">Cellphone Number:</h5>
                            <p id="num" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">'.$row["ContNum"].'</p>
                            <p id="cont" style="display:none;"><input name="cont" class="inp" type="text" value="'.$row["ContNum"].'" disabled></p>
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="cont">
                            <ion-icon name="business" class="add"></ion-icon><br>
                            <h5 class="top">Address:</h5>
                            <p id="add" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">'.$row["Address"].'</p>
                            <p id="address" style="display:none;"><input name="address" class="inp" type="text" value="'.$row["Address"].'" disabled></p>
                            </div>
                            </div>
                            ';
                        }else{
                            echo '
                            <div class="col-md-4">
                            <div class="cont">
                            <ion-icon name="logo-facebook" class="fb"></ion-icon><br>
                            <h3 class="top">Rent IT</h3>
                            <a href=""><input id="p" name="p" class="inp" type="text" value="" disabled></a>
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="cont">
                            <ion-icon name="call" class="call"></ion-icon><br>
                            <h5 class="top">Cellphone Number:</h5>
                            <p><input id="p" name="p" class="inp" type="text" value="" disabled></p>
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="cont">
                            <ion-icon name="business" class="add"></ion-icon><br>
                            <h5 class="top">Address:</h5>
                            <p><input id="p" name="p" class="inp" type="text" value="" disabled></p>
                            </div>
                            </div>
                            ';
                        }
                        ?>