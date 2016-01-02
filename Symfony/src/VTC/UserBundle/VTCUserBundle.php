<?php

namespace VTC\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class VTCUserBundle extends Bundle
{
	public function getParent()
  {
    return 'FOSUserBundle';
  }
}
