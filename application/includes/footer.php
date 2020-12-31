<?php 
    $mail ='';
    $msg ='';
?>
<!--Footer-->
 <footer class="footer">
                <div class="footer-content">
                    <div class="footer-section info">
                        <h1 class="logo-title"><span>Rastot</span> Insight</h2>
                        <p>Rastot Insight is a platform provided by Rastot<span><sup>&reg;</sup></span> for the objective of increasing your depth of knowledge by reading quality articles 
                         and enhancing your skills through creative writing. We are dedicated to instill confidence in you if you are willing to join this wonderful journey of ours. </p>
                        <div class="contact">
                            <!--span><i class="fas fa-phone"></i> &nbsp; 123-456-789</span>-->
                            <span><i class="fas fa-envelope"></i> &nbsp; help@rastot.com</span>
                        </div>
                        <div class="social">
                            <a href="https://www.facebook.com/lifewithrastot"><i class="fab fa-facebook"></i></a>
                            <a href="https://www.youtube.com/channel/UCxZLt6Ja3v8BNQB80u5DoWQ"><i class="fab fa-youtube"></i></a>
                            <a href="https://www.linkedin.com/company/rastot"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            
                        </div>
                         
                    </div>
                    <div class="footer-section links">
                        <h2>Our Products</h2>
                    </br>
                        <ul>
                            <a href="#"><li>IBA MBA Admission Prep</li></a>
                            <a href="#"><li>IBA BBA Admission Prep</li></a>
                            <a href="#"><li>Corporate Job Exam Prep</li></a>
                            <a href="#"><li>GRE Prep</li></a>
                            <a href="#"><li>GMAT Prep</li></a>
                        </ul>
                    </div>
                    <div class="footer-section links">
                        <h2>Company</h2>
                    </br>
                        <ul>
                            <a href="#"><li>About Rastot</li></a>
                            <a href="#"><li>Career</li></a>
                            <a href="#"><li>Mission</li></a>
                            <a href="#"><li>Contact Rastot</li></a>
                            <a href="#"><li>Privacy Policy</li></a>
                            <a href="#"><li>Partner With Us</li></a>
                            <a href="#"><li>Terms and Conditions</li></a>
                        </ul>
                    </div>
                    <div class="footer-section contact-form">
                        <h2>Contact Us</h2>
                        <br>
                        <form action="index.php" method="post">
                            <input type="email" name="footer-email" class="text-input contact-input" placeholder="Your email address..." value="<?php echo $mail; ?>" >
                            <textarea name="footer-message" class="text-input contact-input" rows="4" placeholder="Leave a message..." value="<?php echo $msg; ?>"></textarea>
                            <button type="submit" class="btn btn-big contact-btn" name="footer-btn">
                                <i class="fas fa-envelope"> Send</i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="footer-bottom">
                &copy; Rastot<span><sup>&reg;</sup></span> | <?php echo date("Y", strtotime("-1 years")) .'-' . date("Y"); ?>
                </div>
            </footer>
        <!--//Footer-->

