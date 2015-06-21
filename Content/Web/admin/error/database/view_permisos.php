<div class="col-md-12 page-404">
					<div class="number">
						 500
					</div>
					<div class="details">
						<h3></h3>
						<p>
                                                    
                                                    <?php
                                                    
                                                    if(isset($_REQUEST['err'])):
                                                        if($_REQUEST['err'] == 0):
                                                            echo "Opps! Tenemos algunos problemas tecnicos "
                                                            . ", Favor reflescar la pagina";
                                                        else:   
                                                            echo "Opps!! Nuestro servidor no responde, "
                                                            . " Pronto estara set !!!.";
                                                        endif;
                                                    endif;

                                                    ?>
						
						</p>
						
					</div>
				</div>
