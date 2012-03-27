<?php

require_once 'config.inc.php';

$uri = '';
if (isset($_GET['uri'])
    && preg_match('/https?:\/\//', $_GET['uri'])
    && filter_var($_GET['uri'], FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED)) {
    $uri = htmlentities($_GET['uri'], ENT_QUOTES);
    $ch = curl_init($uri);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_LOW_SPEED_LIMIT, 10);
    curl_setopt($ch, CURLOPT_LOW_SPEED_TIME, 5);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_exec($ch);
    $new_uri = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    if ($new_uri !== $uri) {
        header('Location: ?uri='.urlencode($new_uri));
        exit();
    }
}
?>
<!DOCTYPE html>
<!--[if IEMobile 7 ]><html class="ie iem7"><![endif]-->
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"><![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7) ]><html class="ie" lang="en"><![endif]-->
<!--[if !(IEMobile) | !(IE)]><!--><html lang="en"><!-- InstanceBegin template="/Templates/php.fixed.dwt.php" codeOutsideHTMLIsLocked="false" --><!--<![endif]-->
<head>
<?php virtual("/wdn/templates_3.1/includes/metanfavico.html"); ?>
<!--
    Membership and regular participation in the UNL Web Developer Network
    is required to use the UNL templates. Visit the WDN site at
    http://wdn.unl.edu/. Click the WDN Registry link to log in and
    register your unl.edu site.
    All UNL template code is the property of the UNL Web Developer Network.
    The code seen in a source code view is not, and may not be used as, a
    template. You may not use this code, a reverse-engineered version of
    this code, or its associated visual presentation in whole or in part to
    create a derivative work.
    This message may not be removed from any pages based on the UNL site template.

    $Id: php.fixed.dwt.php | ebd6eef8f48e609f4e2fe9c1d6432991649298e7 | Tue Mar 6 14:38:44 2012 -0600 | Brett Bieber  $
-->
<?php virtual("/wdn/templates_3.1/includes/scriptsandstyles.html"); ?>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Batch Validator | University of Nebraska&ndash;Lincoln</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- Place optional header elements here -->
<link rel="stylesheet" type="text/css" href="/wdn/templates_3.1/css/content/zenform.css" />
<link rel="stylesheet" type="text/css" href="css/batchval.css" />
<script type="text/javascript" src="js/batchval.js"></script>
<script type="text/javascript">var baseURI = '<?php echo $uri; ?>';</script>

<!-- InstanceEndEditable -->
<!-- InstanceParam name="class" type="text" value="fixed" -->
</head>
<body class="fixed" data-version="3.1">
    <nav class="skipnav">
        <a class="skipnav" href="#maincontent">Skip Navigation</a>
    </nav>
    <div id="wdn_wrapper">
        <header id="header" role="banner">
            <a id="logo" href="http://www.unl.edu/" title="UNL website">UNL</a>
            <span id="wdn_institution_title">University of Nebraska&ndash;Lincoln</span>
            <span id="wdn_site_title"><!-- InstanceBeginEditable name="titlegraphic" -->The Title of My Site<!-- InstanceEndEditable --></span>
            <?php virtual("/wdn/templates_3.1/includes/idm.html"); ?>
            <?php virtual("/wdn/templates_3.1/includes/wdnTools.html"); ?>
        </header>
        <div id="wdn_navigation_bar">
            <nav id="breadcrumbs">
                <!-- WDN: see glossary item 'breadcrumbs' -->
                <h3 class="wdn_list_descriptor hidden">Breadcrumbs</h3>
                <!-- InstanceBeginEditable name="breadcrumbs" -->
                <ul>
                    <li class="first"><a href="http://www.unl.edu/">UNL</a></li>
                    <li><a href="http://wdn.unl.edu/"><abbr title="Web Developer Network">WDN</abbr></a></li>
                    <li>Batch Validator</li>
                </ul>
                <!-- InstanceEndEditable -->
            </nav>
            <div id="wdn_navigation_wrapper">
                <nav id="navigation" role="navigation">
                    <h3 class="wdn_list_descriptor hidden">Navigation</h3>
                    <!-- InstanceBeginEditable name="navlinks" -->
                    <?php echo file_get_contents('http://www1.unl.edu/wdn/templates_3.0/scripts/navigationSniffer.php?u=http://wdn.unl.edu/'); ?>
                    <!-- InstanceEndEditable -->
                </nav>
            </div>
        </div>
        <div id="wdn_content_wrapper">
            <div id="pagetitle">
                <!-- InstanceBeginEditable name="pagetitle" -->
                <h1>Batch Validator</h1>
                <!-- InstanceEndEditable -->
            </div>
            <div id="maincontent" role="main">
                <!--THIS IS THE MAIN CONTENT AREA; WDN: see glossary item 'main content area' -->
                <!-- InstanceBeginEditable name="maincontentarea" -->
                <form method="get" action="" class="zenform primary" style="width:930px;margin-top:10px;">
                    <fieldset>
                        <legend>Submit your site for validation</legend>
                        <ol>
                            <li>
                                <label for="name" class="element">
                                    <span class="required">*</span>
                                    URL
                                </label>
                                <input type="text" name="uri" value="<?php echo $uri; ?>" size="80" />
                            </li>
                            <li>
                                <fieldset>
                                   <legend>Additional options:</legend>
                                    <ol>
                                    <!--
                                     <li>
                                        <input id="action_all" type="radio" name="action" value="revalidate" />
                                        <label for="action_all">All pages</label>
                                     </li>
                                     <li>
                                    <input id="action_invalid" type="radio" name="action" value="invalid" />
                                    <label for="action_invalid">Only pages previously identified as invalid <span class="helper">Based on a prior batch validation scan</span></label>
                                     </li>
                                    <li>
                                    <input id="action_links" type="radio" name="action" value="rescan" />
                                    <label for="action_links">Rescan links <span class="helper">What does this do?</span></label>
                                     </li>
                                    -->
                                    <li>
                                    <?php if (isset($_GET['action']) && ($_GET['action'] = 'linkcheck')) {
                                      echo '<input id="action_external" type="radio" name="action" value="linkcheck" checked="checked" />';
                                    } else {
                                        echo '<input id="action_external" type="radio" name="action" value="linkcheck" />';
                                    }?>
                                    
                                    <label for="action_external">Check links <span class="helper">Run a simple check on external URLs to see if they're missing (404)</span></label>
                                     </li>
                                  </ol>
                                </fieldset>
                            </li>
                        </ol>
                    </fieldset>
                    <input type="submit" id="submit" name="submit" value="Submit" />
            </form>
            <h3 id="summaryTitle" class="sec_header">Summary of Scan <span>Revalidate: <a href="#" id="validateInvalid" onclick="validateInvalid(); return false">Invalid Pages</a> | <a href="#" id="validateAll" onclick="validateAll(); return false">All Pages</a></span></h3>
            <div class="clear" id="summaryResults">
                <?php
                
                if (!empty($uri)) {
                    $parts = parse_url($uri);
                    if (!isset($parts['path'])) {
                        echo '<h2>tsk tsk. A trailing slash is always required. Didn\'t saltybeagle ever teach you what a web address is?</h2>';
                        unset($uri);
                    }
                }
                
                if (!empty($uri)) {
                    $assessment = new UNL_WDN_Assessment($uri, $db);
                    $action = 'rescan';
                    
                    if (isset($_GET['action'])) {
                        $action = $_GET['action'];
                    }
                    
                    switch ($action) {
                        case 'revalidate':
                            $assessment->reValidate();
                            break;
                        case 'invalid':
                            $assessment->checkInvalid();
                            break;
                        case 'linkcheck':
                            $assessment->checkLinks();
                            break;
                        case 'remove':
                            $assessment->removeEntries();
                        case 'rescan':
                        default:
                            $assessment->logPages();
                    }
                }
                ?>
            </div>
            <div id="progressReport">
               <h3>We're churning through your site now</h3>
               <p>Here is what we've found so far:</p>
               <ul>
                   <li id="validatedPages"><span class="number">0</span>Pages</li>
                   <li id="validatedErrors"><span class="number">0</span>Errors</li>
                   <li id="validatedWarnings"><span class="number">0</span>Warnings</li>
               </ul>
            
            </div>
                <!-- InstanceEndEditable -->
                <div class="clear"></div>
                <?php virtual("/wdn/templates_3.1/includes/noscript.html"); ?>
                <!--THIS IS THE END OF THE MAIN CONTENT AREA.-->
            </div>
        </div>
        <footer id="footer">
            <div id="footer_floater"></div>
            <div class="footer_col" id="wdn_footer_feedback">
                <?php virtual("/wdn/templates_3.1/includes/feedback.html"); ?>
            </div>
            <div class="footer_col" id="wdn_footer_related">
                <!-- InstanceBeginEditable name="leftcollinks" -->
                <?php echo file_get_contents('http://wdn.unl.edu/sharedcode/relatedLinks.html'); ?>
                <!-- InstanceEndEditable --></div>
            <div class="footer_col" id="wdn_footer_contact">
                <!-- InstanceBeginEditable name="contactinfo" -->
                <h3>Contacting Us</h3>
                <p>
                The WDN is coordinated by:<br />
                <strong>University Communications</strong><br />
                Internet and Interactive Media<br />
                WICK 17<br />
                Lincoln, NE 68583-0218</p>
                <!-- InstanceEndEditable --></div>
            <div class="footer_col" id="wdn_footer_share">
                <?php virtual("/wdn/templates_3.1/includes/socialmediashare.html"); ?>
            </div>
            <!-- InstanceBeginEditable name="optionalfooter" -->
            <!-- InstanceEndEditable -->
            <div id="wdn_copyright">
                <div>
                    <!-- InstanceBeginEditable name="footercontent" -->
                    <?php file_get_contents('http://wdn.unl.edu/sharedcode/footer.html'); ?>
                    <!-- InstanceEndEditable -->
                    <?php virtual("/wdn/templates_3.1/includes/wdn.html"); ?>
                </div>
                <?php virtual("/wdn/templates_3.1/includes/logos.html"); ?>
            </div>
        </footer>
    </div>
</body>
<!-- InstanceEnd --></html>
