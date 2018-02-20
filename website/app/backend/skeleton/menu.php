<?php include_once 'config.php';header('Content-Type: application/json');?>
{
	"menu": [
        {
            "header": "personal",
            "subheader":[
                {
                    "id":"1",
                    "title":"dashboard",
                    "icon_class":"mdi mdi-gauge",
                    "label_class":"label label-rouded label-themecolor pull-right",
                    "menus": [{
                            "title": "minimal",
    			        	"link": "<?php echo $config['theme']?>/index.html"
    				    },
        				{   
	            			"title": "analytical",
			                "link": "<?php echo $config['theme']?>/index2.html"
                        },
                        {   
		        		    "title": "demographical",
    			    	    "link": "<?php echo $config['theme']?>/index3.html"
                        },
                        {   
		                	"title": "modern",
			            	"link": "<?php echo $config['theme']?>/index4.html"
        		        }
        		    ]
                },
                {
                    "id":"2",
                    "title":"apps",
                    "icon_class":"mdi mdi-bullseye",
                    "label_class":"",
                    "menus": [{
                            "title": "calendar",
    			        	"link": "<?php echo $config['theme']?>/app-calendar.html"
    				    },
        				{   
	            			"title": "chat app",
			                "link": "<?php echo $config['theme']?>/app-chat.html"
                        },
                        {   
		        		    "title": "support ticket",
    			    	    "link": "<?php echo $config['theme']?>/app-ticket.html"
                        },
                        {   
		                	"title": "contact / employee",
			            	"link": "<?php echo $config['theme']?>/app-contact.html"
                        },
                        {   
		                	"title": "contact grid",
			            	"link": "<?php echo $config['theme']?>/app-contact2.html"
        		        },
                        {   
		                	"title": "contact detail",
			            	"link": "<?php echo $config['theme']?>/app-contact-detail.html"
        		        }
        		    ]
                },
                {
                    "id":"3",
                    "title":"inbox",
                    "icon_class":"mdi mdi-email",
                    "label_class":"",
                    "menus": [{
                            "title": "mailbox",
    			        	"link": "<?php echo $config['theme']?>/app-email.html"
    				    },
        				{   
	            			"title": "mailbox detail",
			                "link": "<?php echo $config['theme']?>/app-email-detail.html"
                        },
                        {   
		        		    "title": "compose mail",
    			    	    "link": "<?php echo $config['theme']?>/app-compose.html"
                        }
        		    ]
                }
            ]
		},
		{
			"header": "widget",
            "subheader":[
                {
                    "id":"3",
                    "title":"forms",
                    "icon_class":"mdi mdi-file",
                    "menus": [{
                            "title": "basic forms",
                            "link": "basic-forms/",
                            "label_class":"label label-rounded label-success",
                            "submenus": [{
                                    "title": "sub basic forms",
                                    "link": "sub-basic-forms/"
                                },
                                {
                                    "title": "sub form layout",
                                    "link": "sub-form-layout/"
                                }
                            ]
				        },
	    			    {
                            "title": "form layout",
    			    		"link": "form-layout/"
	    			    }
		    	    ]
                }
            ]
		}
	]
}