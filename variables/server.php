<?php

	/* This is required for various in house REST API calls, redirections and link generations. Set the value carefully otherwise things will not work.
	   Remember: It MUST contain the protocol i.e. http:// or https:// and also it MUST NOT contain '/' at the end. See the examples below */

	class Server
	{
		static $root = 'enter_something_here';			// Enter your root server location. Examples, http://www.anirbanatweb.pe.hu or http://localhost/stelin 
	}

?>