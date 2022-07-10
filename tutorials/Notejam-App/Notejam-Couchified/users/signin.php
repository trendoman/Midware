<?php require_once( '../couch/cms.php' ); ?>
    <cms:template title='Users / Sign In' hidden='1' />
    
    <cms:if k_logged_in >

        <!-- this 'login' template also handles 'logout' requests. Check if this is so -->
        <cms:set action="<cms:gpc 'act' method='get'/>" />
    
        <cms:if action='logout' >
            <cms:process_logout />
        <cms:else />  
            <!-- what is an already logged-in member doing on the login page? Send back to homepage. -->
            <cms:redirect k_site_link />
        </cms:if>
    
    <cms:else />
    
        <!-- show the login form -->
        <cms:capture into='my_content' >
            <cms:form class="offset-by-six sign-in" method='post' anchor='0'>
            
                <cms:if k_success >
                    <cms:process_login />
                </cms:if>
                
                <cms:if k_error>
                    <div class="alert-area">
                        <div class="alert alert-error">
                            <cms:each k_error >
                                <cms:show item /><br>
                            </cms:each>
                        </div>
                    </div>
                </cms:if>
                
                <label for="email">Email</label>
                <cms:input name='k_user_name' type="text" id="email" />
                
                <label for="password">Password</label>
                <cms:input name='k_user_pwd' type="password" id="password" />
                
                <input type="hidden" name="k_cookie_test" value="1" />
                
                <input type="submit" value="Sign In">
                <cms:if k_user_registration_template >
                    or <a href="<cms:link k_user_registration_template />">Sign up</a>
                </cms:if>
                
                <cms:if k_user_lost_password_template >
                <hr />
                <p><a href="<cms:link k_user_lost_password_template />" class="small-red">Forgot password?</a></p>
                </cms:if>
                
            </cms:form>
        </cms:capture>

        
        <cms:set my_title="Sign In" />

        <cms:embed 'views/layout_main.html' />
    
    </cms:if>
    
<?php COUCH::invoke(); ?> 



