<?php

/*
 * This file is part of Monsieur Biz's SyliusUiElementsPlugin for Sylius.
 * (c) Monsieur Biz <sylius@monsieurbiz.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace MonsieurBiz\SyliusUiElementsPlugin\Form\Type\UiElement;

use MonsieurBiz\SyliusRichEditorPlugin\Attribute\AsUiElement;
use MonsieurBiz\SyliusRichEditorPlugin\Attribute\TemplatesUiElement;
use MonsieurBiz\SyliusRichEditorPlugin\Form\Type\WysiwygType;
use MonsieurBiz\SyliusRichEditorPlugin\WysiwygEditor\EditorInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[AsUiElement(
    code: 'monsieurbiz_ui_elements.framed_text_ui_element',
    icon: 'font',
    title: 'monsieurbiz_ui_elements.ui_element.framed_text_ui_element.title',
    description: 'monsieurbiz_ui_elements.ui_element.framed_text_ui_element.description',
    templates: new TemplatesUiElement(
        adminRender: '@MonsieurBizSyliusUiElementsPlugin/Admin/UiElement/framed_text_ui_element.html.twig',
        frontRender: '@MonsieurBizSyliusUiElementsPlugin/Shop/UiElement/framed_text_ui_element.html.twig',
    ),
    tags: [],
    wireframe: 'framed-text',
)]
class FramedTextUiElementType extends AbstractType
{
    public const BACKGROUND_LIGHT = 'light';

    public const BACKGROUND_DARK = 'dark';

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', WysiwygType::class, [
                'label' => 'monsieurbiz_ui_elements.common.fields.content',
                'required' => true,
                'editor_toolbar_type' => EditorInterface::TOOLBAR_TYPE_MINIMAL,
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('background', ChoiceType::class, [
                'label' => 'monsieurbiz_ui_elements.common.fields.background',
                'choices' => [
                    'monsieurbiz_ui_elements.common.form_choices.background.light' => self::BACKGROUND_LIGHT,
                    'monsieurbiz_ui_elements.common.form_choices.background.dark' => self::BACKGROUND_DARK,
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
        ;
    }
}
