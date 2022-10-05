<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Email;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('first_name', TextType::class, [
            'attr' => [
                'placeholder' => 'Prénom',
                'min' => 8,
                'max' => 100
            ],
            'required' => true,
            
            ])
        ->add('last_name', TextType::class, [
            'attr' => [
                'placeholder' => 'Nom',
                'min' => 8,
                'max' => 100
            ],
            'required' => true,
            
            ])
            ->add('adress', TextType::class, [
                'attr' => [
                    'placeholder' => 'Adresse',
                    'min' => 8,
                    'max' => 100
                ],
                'required' => true,
                
                ]) 
                ->add('city', TextType::class, [
                    'attr' => [
                        'placeholder' => 'Ville',
                        'min' => 8,
                        'max' => 50
                    ],
                    'required' => true,
                    
                    ])

                    ->add('postal_code', TextType::class, [
                        'attr' => [
                            'placeholder' => 'CP',
                            'min' => 8,
                            'max' => 20
                        ],
                        'required' => true,
                        
                        ])



        ->add('email', EmailType::class, [
            'attr' => [
                'placeholder' => 'Adresse mail'
            ],
            'required' => true,
            'constraints' => [
                new NotBlank([
                    'message' => 'Ce champ ne peut pas être vide !'
                ]),
                new email([
                    'mode' => "html5",
                    'message' => 'Ce texte n\'est pas une adresse mail !'
                ]),
                new Length([
                    'min' => 8,
                    'max' => 100,
                    'minMessage' => '8 caractères est le nombre minimum pour une adresse mail !',
                    'maxMessage' => 'Trop de caracteres !'
                ])
            ]
        ])

        ->add('phone_number', TelType::class, [
            'attr' => [
                'placeholder' => 'Téléphone',
                'min' => 8,
                'max' => 100
            ],
            'required' => true,
            
            ])

            
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                
                'attr' => ['autocomplete' => 'new-password',
                'placeholder' => 'Mot de passe'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                ])
                ->add('agreeTerms', CheckboxType::class, [
                    'mapped' => false,
                    'constraints' => [
                        new IsTrue([
                            'message' => 'You should agree to our terms.',
                        ]),
                    ],
                ])
                ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
