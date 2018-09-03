<?php

/*
 * The MIT License
 *
 * Copyright 2018 Juan Diaz - FuriosoJack <iam@furiosojack.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 * @license https://raw.githubusercontent.com/FuriosoJack/MasterModelsAWS/master/LICENSE
 */

namespace FuriosoJack\MasterModelsAWS\Operations\Requests\Rekognition\Faces;

/**
 * Description of SearchFacesByImage
 *
 * @package FuriosoJack\MasterModelsAWS\Operations\Requests\Rekognition\Faces 
 * @author Juan Diaz - FuriosoJack <http://blog.furiosojack.com/>
 * @version 
 * @access 
 */
class SearchFacesByImage extends \FuriosoJack\MasterModelsAWS\Operations\Requests\Rekognition\AbstractRequestRekognition
{
    
    protected function getMethodName(): string
    {
        return 'searchFacesByImage';
    }

    /**
     * @link https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#searchfacesbyimage
     * @return array
     */
    protected function getParameters(): array
    {
        return [
          'required' => [
              'CollectionId',
              'Image'              
          ],
           'optional' => [
                'MaxFaces'
           ] 
        ];
    }

}
