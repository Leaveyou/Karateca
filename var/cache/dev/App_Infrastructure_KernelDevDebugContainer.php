<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerWrEt0XP\App_Infrastructure_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerWrEt0XP/App_Infrastructure_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerWrEt0XP.legacy');

    return;
}

if (!\class_exists(App_Infrastructure_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerWrEt0XP\App_Infrastructure_KernelDevDebugContainer::class, App_Infrastructure_KernelDevDebugContainer::class, false);
}

return new \ContainerWrEt0XP\App_Infrastructure_KernelDevDebugContainer([
    'container.build_hash' => 'WrEt0XP',
    'container.build_id' => '46995aaf',
    'container.build_time' => 1688252966,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerWrEt0XP');
