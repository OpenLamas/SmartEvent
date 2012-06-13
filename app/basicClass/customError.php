<?php
  class ManchotError extends Exception {};

  class NotFoundError extends Exception {};

  class ForbiddenError extends Exception {};

/*
	throw new ForbiddenError ("Le module ".$module." n'existe pas");
	throw new NotFoundError ("Le module ".$module." n'existe pas");
*/


?>