<?php

/**
 * @see       https://github.com/laminas/laminas-form for the canonical source repository
 * @copyright https://github.com/laminas/laminas-form/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-form/blob/master/LICENSE.md New BSD License
 */

namespace LaminasTest\Form\TestAsset;

use Laminas\Form\Fieldset;
use Laminas\Hydrator\ArraySerializable;
use Laminas\Hydrator\ArraySerializableHydrator;
use Laminas\InputFilter\InputFilterProviderInterface;
use LaminasTest\Form\TestAsset\Entity\Orphan;

use function class_exists;

class OrphansFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);

        $this
            ->setHydrator(
                class_exists(ArraySerializableHydrator::class)
                    ? new ArraySerializableHydrator()
                    : new ArraySerializable()
            )
            ->setObject(new Orphan());

        $this->add([
            'name'    => 'name',
            'options' => ['label' => 'Name field'],
        ]);
    }

    public function getInputFilterSpecification()
    {
        return [
            'name' => [
                'required'   => false,
                'filters'    => [],
                'validators' => [],
            ],
        ];
    }
}
