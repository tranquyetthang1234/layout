<?php
/**
 * Created by PhpStorm.
 * User: reishou
 * Date: 2018-11-23
 * Time: 16:25
 */

namespace App\Providers;

use ReflectionClass;

trait ProviderRegister
{
    /**
     * @param $name
     * @return array
     * @throws \ReflectionException
     */
    protected function getAbstractClass($name)
    {
        $abstracts = [];
        $finder = new \Symfony\Component\Finder\Finder();
        $finder->files()
            ->name('*'. studly_case($name) . '.php')
            ->in(base_path() . $this->path['abstract']);
        foreach ($finder as $file) {
            $namespace = $this->namespace['abstract'];
            if ($relativePath = $file->getRelativePath()) {
                $namespace .= '\\' . strtr($relativePath, '/', '\\');
            }
            $class = $namespace . '\\' . $file->getBasename('.php');

            $r = new ReflectionClass($class);

            if ($r->isInterface()) {
                $abstracts[$file->getBasename('.php')] = $class;
            }
        }

        return $abstracts;
    }

    /**
     * @param $name
     * @return array
     * @throws \ReflectionException
     */
    protected function getConcreteClass($name)
    {
        $concretes = [];
        $finder = new \Symfony\Component\Finder\Finder();
        $finder->files()
            ->name('*'. studly_case($name) . '.php')
            ->in(base_path() . $this->path['concrete']);
        foreach ($finder as $file) {
            $namespace = $this->namespace['concrete'];
            if ($relativePath = $file->getRelativePath()) {
                $namespace .= '\\' . strtr($relativePath, '/', '\\');
            }
            $class = $namespace . '\\' . $file->getBasename('.php');

            $r = new ReflectionClass($class);

            if (!$r->isInterface() && !$r->isAbstract()) {
                $concretes[$file->getBasename('.php')] = $class;
            }
        }

        return $concretes;
    }

    public function getListProduct(Request $request)
    {
        $url = $request->segment(2);
        $url = preg_split('/(-)/i', $url);

        if($id = array_pop($url)) {
            $product = Product::where([
                'active' =>1,
                'x' => 2
            ])->orderBy('id', 'DESC')->paginate(10);

            return view() ;
        }

        return ;
    }
}
