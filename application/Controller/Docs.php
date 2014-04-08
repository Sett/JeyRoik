<?php
/**
 * Class Controller_Docs
 */
trait Controller_Docs
{
    /**
     * @onEvent docs/traits
     * @context request params
     * @param array $request
     * @return array
     */
    public function traitsInDocs($request = [])
    {
        $this->addLayoutTitle('Документация - Трейты');
        $this->addKeywords('трейты', 'документация');
        $this->pageTitle = 'Трейты';

        return $request;
    }

    /**
     * @onEvent docs/roles
     * @context request params
     * @param array $request
     * @return array
     */
    public function rolesInDocs($request = [])
    {
        $this->addLayoutTitle('Документация - Роли');
        $this->addKeywords('роли', 'документация');
        $this->pageTitle = 'Роли';

        return $request;
    }

    /**
     * @onEvent docs/events
     * @context request params
     * @param array $request
     * @return array
     */
    public function eventsInDocs($request = [])
    {
        $this->addLayoutTitle('Документация - События');
        $this->addKeywords('события', 'документация');
        $this->pageTitle = 'События';

        return $request;
    }

    /**
     * @onEvent docs/extend
     * @context request params
     * @param array $request
     * @return array
     */
    public function extendInDocs($request = [])
    {
        $this->addLayoutTitle('Документация - Расширяемость');
        $this->addKeywords('расширяемость', 'документация');
        $this->pageTitle = 'Расширяемость';

        return $request;
    }

    /**
     * @onEvent docs/mvc
     * @context request params
     * @param array $request
     * @return array
     */
    public function mvcInDocs($request = [])
    {
        $this->addLayoutTitle('Документация - MVA');
        $this->addKeywords('mva', 'документация');
        $this->pageTitle = 'MVA';

        return $request;
    }
}
