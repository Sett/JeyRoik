<?php

trait Controller_Docs
{
    public function traitsInDocs($request = [])
    {
        $this->addLayoutTitle('Документация - Трейты');
        $this->addKeywords('трейты', 'документация');
        $this->pageTitle = 'Трейты';

        return $request;
    }

    public function rolesInDocs($request = [])
    {
        $this->addLayoutTitle('Документация - Роли');
        $this->addKeywords('роли', 'документация');
        $this->pageTitle = 'Роли';

        return $request;
    }

    public function eventsInDocs($request = [])
    {
        $this->addLayoutTitle('Документация - События');
        $this->addKeywords('события', 'документация');
        $this->pageTitle = 'События';

        return $request;
    }

    public function extendInDocs($request = [])
    {
        $this->addLayoutTitle('Документация - Расширяемость');
        $this->addKeywords('расширяемость', 'документация');
        $this->pageTitle = 'Расширяемость';

        return $request;
    }

    public function mvcInDocs($request = [])
    {
        $this->addLayoutTitle('Документация - MVA');
        $this->addKeywords('mva', 'документация');
        $this->pageTitle = 'MVA';

        return $request;
    }
}
